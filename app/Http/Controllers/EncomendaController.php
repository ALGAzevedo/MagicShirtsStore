<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaUpdatePost;
use App\Mail\EncomendaEnviada;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;
use Exception;
use App\Notifications\EncomendaAnulada;
use App\Notifications\EncomendaPaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;



class EncomendaController extends Controller
{

    public function create(Estampa $estampa)
    {
        $listaCores = Cor::all();
        $estampa = Estampa::findOrFail($estampa->id);
        return view('encomendas.create', compact('listaCores', 'estampa'));
    }

    public function index(Request $request) {
        //pesquisar por data/estado encomenda


        $estadoSel = $request->estado ?? '';
        $dataSel = $request->data ?? '';

        $encomendas = Encomenda::where('cliente_id', Auth::user()->id);


        if($estadoSel) {
            $encomendas->where('estado', '=', $estadoSel);
        }
        if($dataSel) {
            $encomendas->where('data', '=', $dataSel);
        }

        $encomendas = $encomendas->orderBy('id', 'desc')->paginate(6);;

        return view('encomendas.index', compact('encomendas','estadoSel', 'dataSel'));
    }

    public function view_encomenda(Encomenda $encomenda) {
        $shirts = Tshirt::where('encomenda_id', '=', $encomenda->id)->get();

        return view('encomendas.viewEncomenda', compact('encomenda', 'shirts'));

    }


    public function admin_index(Request $request)
    {
        $estadoSel = $request->estado ?? '';
        $dataSel = $request->data ?? '';
        $cliente_idSel = $request->cliente_id ?? '';
        $referencia_pagamentoSel = $request->referencia_pagamento ?? '';



        //Pode pesquisar por estado que requisitou?
        $this->authorize('viewEstado', [Encomenda::class,  $estadoSel]);


        if ($request->hasAny(['data', 'cliente_id', 'referencia_pagamento'])) {
            //utilizador em questão pode consultar por data/cliente?
            $this->authorize('viewAny', [Encomenda::class,  $estadoSel]);

        }

        $qry = Encomenda::query();

        //se for a primeira vez nas encomendas temos de mostrar apenas as autorizadas para cada user
        //no caso dos funcionarios apenas onde o estado é paga ou pendente, vamos pré preencher para pendentes
        if(!$estadoSel && !Gate::allows('viewAllEstados', Encomenda::class)) {
            $estadoSel = "pendente";
            $qry->where('estado', '=', $estadoSel);
        }

        if($estadoSel) {
            $qry->where('estado', "=", $estadoSel);
        }

        //Se user pesquisou por data
        if($dataSel) {
            $qry->where('data', "=", $dataSel);
        }

        //Se user pesquisou por cliente ID
        if($cliente_idSel) {
            $qry->where('cliente_id', "=", $cliente_idSel);
        }

        //se user pesquisoupor ref de pagamento
        if($referencia_pagamentoSel) {
            $qry->where('ref_pagamento', "=", $referencia_pagamentoSel);
        }




        $encomendas = $qry->orderBy('id', 'DESC')->paginate(10);


        return view('encomendas.admin',
            compact('encomendas', 'estadoSel', 'dataSel', 'cliente_idSel', 'referencia_pagamentoSel'));
    }

    public function admin_edit(Encomenda $encomenda)
    {

        $estadoAtual = $encomenda->estado;
        $estadoSeguinte = null;

        //Botão que irá aparecer ao funcionário
        if($estadoAtual == "pendente") {
            $estadoSeguinte = "paga";
        }
        else if($estadoAtual == "paga") {
            $estadoSeguinte = "fechada";
        }

        $shirts = Tshirt::where('encomenda_id', '=', $encomenda->id)->get();



        return view('encomendas.edit', compact('encomenda', 'estadoSeguinte', 'shirts'));
    }


    public function admin_update(EncomendaUpdatePost $request, Encomenda $encomenda)
    {

        $validated_data = $request->validated();
        $estado = $validated_data['estado'];

        //verifica se user pode anular encomenda

        if($estado == 'anulada') {
            $this->authorize('updateAnular', Encomenda::class);
            Auth::user()->notify((new EncomendaAnulada($encomenda, $encomenda->cliente_id))->delay(now()->addSeconds(10)));
        }


        $encomenda->estado = $estado;

        if($estado == 'paga'){
            Auth::user()->notify((new EncomendaPaga($encomenda, $encomenda->cliente_id))->delay(now()->addSeconds(10)));
        }

        if($estado == 'fechada'){
            $pdf = $this->createPdf($encomenda);
            $output = $pdf->output();
            $name = 'FTMS'.$encomenda->id.'.pdf';
            file_put_contents('storage/recibos/'.$name, $output);

            $encomenda->recibo_url = basename($name);
            $encomenda->save();

            Mail::to(Auth::user())
                ->queue(new EncomendaEnviada($encomenda, Auth::id()));
        }

        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    private function createPdf(Encomenda $encomenda){
        $shirts = Tshirt::where('encomenda_id', '=', $encomenda->id)->get();
        $pdf = PDF::loadView('fatura.index', compact('encomenda', 'shirts'));

        //return $pdf->download('FT MS' . $encomenda->id . '.pdf');

        return $pdf;

    }

    public function openPdf(Encomenda $encomenda) {

        $filename = 'storage/recibos/'.$encomenda->recibo_url;

        try {
            $data = file_get_contents($filename);
            return response()->make($data, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        }
        catch (Exception $ex) {
            abort(404);
        }
    }

    public function downloadPdf(Encomenda $encomenda) {

        $filename = 'storage/recibos/'.$encomenda->recibo_url;

        try {
            return response()->download($filename);
        }
        catch (Exception $ex) {
            abort(404);
        }
    }
}
