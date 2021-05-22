<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Estampa;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function choose(Request $request)
    {
        $listaCores = Cor::all();
        $cor =$request->query('cor', $listaCores[0]->codigo);
        $corSel = Cor::findOrFail($cor);

        $listaEstampas = Estampa::all();
        $estampaRef =$request->query('estampa', $listaEstampas[0]->id);
        $estampa = Estampa::findOrFail($estampaRef);

        return view('tshirts.create', compact('listaCores', 'estampa', 'corSel'));
    }

    public function chooseWithColor(Estampa $estampa, Cor $cor)
    {
        $listaCores = Cor::all();
        $corSel = $cor;
        $estampa = Estampa::findOrFail($estampa->id);
        return view('tshirts.create', compact('listaCores', 'estampa', 'corSel'));
    }
}
