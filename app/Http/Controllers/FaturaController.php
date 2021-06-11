<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Tshirt;
use Illuminate\Http\Request;

class FaturaController extends Controller
{
    public function index(Encomenda $encomenda) {

        $shirts = Tshirt::where('encomenda_id', '=', $encomenda->id)->get();



        return view('fatura.index', compact('encomenda', 'shirts'));
    }
}
