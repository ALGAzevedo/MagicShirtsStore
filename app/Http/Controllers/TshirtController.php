<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Estampa;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function choose(Estampa $estampa)
    {

        $listaCores = Cor::all();
        $estampa = Estampa::findOrFail($estampa->id);
        return view('tshirts.create', compact('listaCores', 'estampa'));
    }
}
