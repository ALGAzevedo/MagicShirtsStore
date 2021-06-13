<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function index()
    {

        if (!cache()->has('_categorias')) {
            //Por ser muito pesada a query, guardamos na cache durante 5 minutos
            $estampasq = Estampa::query()
                    ->join('tshirts', 'tshirts.estampa_id', '=', 'estampas.id')
                    ->selectRaw('estampas.*, SUM(tshirts.quantidade) AS quantidade_vend')
                    ->groupBy(['estampas.id'])
                    ->orderByDesc('quantidade_vend')
                    ->take(4)->get();

            cache()->put('_categorias', $estampasq, now()->addMinutes(10));
        }

        if (!cache()->has('_randCategorias')) {

            $randcat = Categoria::withoutTrashed()
                ->take(7)
                ->inRandomOrder()
                ->get();

            cache()->put('_randCategorias', $randcat, now()->addMinutes(10));

        }

        $categorias = cache()->get('_randCategorias');
        $estampas = cache()->get('_categorias');



        return view('pages.index', compact('estampas','categorias'));
    }

    public function about(){
        return view('pages.about')
            ->with('pageTitle', 'About');
    }
}
