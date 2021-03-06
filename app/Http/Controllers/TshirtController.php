<?php

namespace App\Http\Controllers;

use App\Http\Traits\TshirtTrait;
use App\Models\Cor;
use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    use TshirtTrait;

    public function choose(Estampa $estampa, Request $request)
    {


        $listaCores = Cor::query();
        $listaCores = $listaCores->whereNotNull('nome')->orderBy('nome')->get();
        $cor =$request->query('cor', $listaCores[0]->codigo);
        $corSel = Cor::findOrFail($cor);

        //Lista de tamanhos
        $tamanhos = $this->tshirtSizes();

        //$listaEstampas = Estampa::all();
        //$estampaRef =$request->query('estampa', $listaEstampas[0]->id);

        $estampa = Estampa::findOrFail($estampa->id);

        $preco = $this->getPrice();

        return view('tshirts.create', compact('listaCores', 'estampa', 'corSel', 'preco','tamanhos'));
    }

    public function chooseWithColor(Estampa $estampa, Cor $cor)
    {
        $listaCores = Cor::all();
        $corSel = $cor;
        $estampa = Estampa::findOrFail($estampa->id);
        return view('tshirts.create', compact('listaCores', 'estampa', 'corSel'));
    }

    private function getPrice(){
        $precos = Preco::all();
        //foreach($precos as $preco)
            return $precos[0];
    }


}
