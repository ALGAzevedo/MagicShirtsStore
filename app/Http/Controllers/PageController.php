<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function index()
    {
        //Por ser muito pesada a query, guardamos na cache durante 5 minutos
        $estampas = Cache::remember('categorias', 300, function () {
                   return Estampa::query()
                       ->join('tshirts', 'tshirts.estampa_id', '=', 'estampas.id')
                       ->selectRaw('estampas.*, SUM(tshirts.quantidade) AS quantidade_vend')
                       ->groupBy(['estampas.id'])
                       ->orderByDesc('quantidade_vend')
                       ->take(4)->get();
               });

        return view('pages.index', compact('estampas'));
    }

    public function about(){
        return view('pages.about')
            ->with('pageTitle', 'About');
    }
}
