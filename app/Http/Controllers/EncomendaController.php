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
        $estadoSel = $request->estado ?? 'pendente';

        $this->authorize('viewEstado', [Encomenda::class,  $estadoSel]);

        $qry = Encomenda::query();

        //se for a primeira vez nas encomendas temos de mostrar apenas as autorizadas para cada user
        //no caso dos funcionarios apenas onde o estado é paga ou pendente
        if(!$estadoSel && !Gate::allows('viewAllEstados', Encomenda::class)) {
            $qry->where('estado', '=', 'pendente')
                ->where('estado', '=', 'paga');

        }

        if($estadoSel && $estadoSel != 'Mostrar tudo') {
            $qry->where('estado', $estadoSel);
        }


        //Estados que users podem selecionar
        $listaEstados = array();

        //apenas administrador pode ver encomendas anuladas e fechadas
        if(Gate::allows('viewAllEstados', Encomenda::class)) {
            array_push($listaEstados, "mostrar tudo", "fechada", "anulada");
        }
        //todos podem ver pendentes e pagas
        array_push($listaEstados, "pendente", "paga");

        $encomendas = $qry->paginate(10);


        return view('encomendas.admin',
            compact('encomendas', 'listaEstados', 'estadoSel'));
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
        //Se o request for para alterar o estado para anulada temos ainda de verificar se o user o pode fazer
        $this->authorize('updateAnular', Encomenda::class);


        $validated_data = $request->validated();

        $encomenda->estado = $validated_data['estado'];

        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }



}
