<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaUpdatePost;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Policies\EncomendaPolicy;



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


        $fullAuthorized = null;

        if(!Auth::user()->can('view-estado', [ Encomenda::class, $estadoSel ] ) ) {
            abort(403);
        }

        if(Auth::user()->tipo == 'A') {
            $fullAuthorized = true;
        }
        else {
            $fullAuthorized = false;
        }


        $qry = Encomenda::query();

        //se for a primeira vez nas encomendas temos de mostrar apenas as autorizadas para cada user
        //no caso dos funcionarios apenas onde o estado é paga ou pendente
        if(!$estadoSel && !$fullAuthorized) {
            $qry->where('estado', 'paga')
                ->where('estado', 'pendente');
        }


        if($estadoSel && $estadoSel != 'Mostrar tudo') {
            $qry->where('estado', $estadoSel);
        }

        $listaEstados = array();

        //apenas administrador pode ver encomendas anuladas e fechadas
        if($fullAuthorized == true) {
            array_push($listaEstados, "Mostrar tudo", "fechada", "anulada");
        }

        array_push($listaEstados, "pendente", "Paga");

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

        $shirts = Tshirt::where('encomenda_id', $encomenda->id)->get();



        return view('encomendas.edit', compact('encomenda', 'estadoSeguinte', 'shirts'));
    }


    public function admin_update(EncomendaUpdatePost $request, Encomenda $encomenda)
    {
        $validated_data = $request->validated();

        $encomenda->estado = $validated_data['estado'];

        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }



}
