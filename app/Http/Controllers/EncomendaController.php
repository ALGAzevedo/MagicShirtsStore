<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaUpdatePost;
use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use function Sodium\add;

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

        $qry = Encomenda::query();

        if($estadoSel && $estadoSel != 'show_all') {
            $qry->where('estado', $estadoSel);
        }

        //todos os estados possiveis
        $listaEstados = array("pendente", "Fechada", "Anulada", "Paga");


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
