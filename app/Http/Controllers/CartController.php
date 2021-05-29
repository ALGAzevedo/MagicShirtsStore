<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function add_item(CartRequest $request)
    {
        //Validação
        $request->validated();

        $estampa_id = $request->estampa_id;
        $uuid = (string) $request->cor_codigo.$estampa_id.$request->tamanho;
        $estampa = Estampa::findOrFail($estampa_id);

        $carrinho = session()->get('carrinho', []);

        $quantidade = ($carrinho[$uuid]['quantidade'] ?? 0) + 1;

        $cartItem = [
            'uuid' => $uuid,
            'nome' => $estampa->nome,
            'cor_codigo' => $request->cor_codigo,
            'estampa_id' => $estampa_id,
            'tamanho' => $request->tamanho,
            'quantidade' => intval($quantidade),
            'preco_un' => floatval(5),
            'subtotal' => floatval(10),
        ];

        $carrinho[$uuid] = $cartItem;
        
        session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', "Adicionou $estampa->nome ao carrinho de compras.")
            ->with('alert-type', 'success');

    }


}
