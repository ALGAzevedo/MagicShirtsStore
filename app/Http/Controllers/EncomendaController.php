<?php

namespace App\Http\Controllers;

use App\Models\Cor;
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


}
