<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Encomenda;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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
        $listaEstados = array("Fechada", "Anulada", "Paga");


        $encomendas = $qry->paginate(10);

        return view('encomendas.admin',
            compact('encomendas', 'listaEstados', 'estadoSel'));
    }



}
