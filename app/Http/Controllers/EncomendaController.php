<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaUpdatePost;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;




class EncomendaController extends Controller
{

    public function create(Estampa $estampa)
    {
        $listaCores = Cor::all();
        $estampa = Estampa::findOrFail($estampa->id);
        return view('encomendas.create', compact('listaCores', 'estampa'));
    }


    public function admin_index(Request $request)
    {
        $estadoSel = $request->estado ?? '';
        $dataSel = $request->data ?? '';
        $cliente_idSel = $request->cliente_id ?? '';

        //Pode pesquisar por estado que requisitou?
        $this->authorize('viewEstado', [Encomenda::class,  $estadoSel]);


        if ($request->hasAny(['data', 'cliente_id'])) {
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

        $encomendas = $qry->paginate(10);


        return view('encomendas.admin',
            compact('encomendas', 'estadoSel', 'dataSel', 'cliente_idSel'));
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
        }





        $encomenda->estado = $estado;

        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }



}
