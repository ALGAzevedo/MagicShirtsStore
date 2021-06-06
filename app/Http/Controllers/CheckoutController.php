<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        return view('checkout.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function review($id)
    {
        return view('checkout.order')
            ->with('pageTitle', 'Confirmar')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function store(Request $request)
    {
        return view('checkout.thankyou')
            ->with('pageTitle', 'Obrigado')
            ->with('carrinho', session('carrinho') ?? []);
    }


}
