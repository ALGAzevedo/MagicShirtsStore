<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Tshirt;
use App\Notifications\EncomendaRecebida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        if(session()->missing('carrinho_qty') || session('carrinho_qty') <= 0)
            return redirect()->route('carrinho'); //Para evitar o Erro ERR_TOO_MANY_REDIRECTS

        $cliente =  Cliente::findOrFail(Auth::id());
        return view('checkout.index')
            ->with('pageTitle', 'Checkout')
            ->with('carrinho', session('carrinho') ?? [])
            ->with('cliente',$cliente);
    }

    public function store(CheckoutRequest $request)
    {
        if(session()->missing('carrinho_qty') || session('carrinho_qty') <= 0)
            return redirect()->route('carrinho'); //Para evitar o Erro ERR_TOO_MANY_REDIRECTS

        $validated_data = $request->validated();

        $encomenda = new Encomenda;

        //$encomenda->fill($validated_data);


        $encomenda->cliente_id = Auth::id();
        $encomenda->estado = "pendente";
        $encomenda->data = Carbon::now()->isoFormat('YYYY-MM-DD');

        $encomenda->preco_total = Cart::subtotal();
        $encomenda->notas = $validated_data['notas'];
        $encomenda->nif = $validated_data['nif'];
        $encomenda->endereco = $validated_data['endereco'];
        $encomenda->tipo_pagamento = $validated_data['tipo_pagamento'];
        $encomenda->ref_pagamento = $validated_data['ref_pagamento'];

        $encomenda->save();

        //TODO: RECIBO_URL

        if ($encomenda->id){

            $items = Cart::getContent();

            foreach ($items as $key=>$item){
                $tshirt = new Tshirt;
                $tshirt->encomenda_id = $encomenda->id;
                $tshirt->estampa_id = $item['estampa_id'];
                $tshirt->cor_codigo = $item['cor_codigo'];
                $tshirt->tamanho = $item['tamanho'];
                $tshirt->quantidade = $item['quantidade'];
                $tshirt->preco_un = $item['preco_un'];
                $tshirt->subtotal = $item['subtotal'];

                $tshirt->save();


            }
        }


        Auth::user()->notify((new EncomendaRecebida($encomenda, Auth::user()))->delay(now()->addSeconds(10)));
        Cart::destroy();

        return redirect()->route('cliente.encomenda.view', ['encomenda' => $encomenda])
            ->with('alert-msg', 'Encomenda "#' . $encomenda->id . '" foi registada com sucesso!')
            ->with('alert-type', 'success');

    }

    public function confirm(Request $request)
    {
        return view('checkout.thankyou')
            ->with('pageTitle', 'Obrigado')
            ->with('carrinho', session('carrinho') ?? []);
    }

}
