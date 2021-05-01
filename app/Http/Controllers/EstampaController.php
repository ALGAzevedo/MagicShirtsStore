<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    public function index()
    {
        $estampas = Estampa::all();
        return view('estampas.index')->withEstampas($estampas);
    }

}
