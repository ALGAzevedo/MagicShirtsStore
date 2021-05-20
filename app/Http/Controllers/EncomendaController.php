<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function create()
    {
        $listaCores = Cor::all();
        return view('encomendas.create', compact('listaCores'));
    }


}
