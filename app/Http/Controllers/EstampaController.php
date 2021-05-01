<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::all();
        $id = $request->query('disc', $listaCategorias[0]->id);
        $categoria = Categoria::findOrFail($id);
        $estampas = Estampa::where('categoria_id', $id)->get();
        return view(
            'estampas.index',
            compact('listaCategorias','estampas', 'categoria'));
    }

}
