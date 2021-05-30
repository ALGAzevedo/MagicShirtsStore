<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function update_item(Request $request, String $id)
    {
       return $id;
    }
    public function add_item(CartRequest $request)
    {
        //Validação
        $request->validated();

        $estampa_id = $request->estampa_id;
        $uuid = (string) $request->cor_codigo.$estampa_id.$request->tamanho;
        $estampa = Estampa::findOrFail($estampa_id);

        $carrinho = session()->get('carrinho', []);

        $quantidade = ($carrinho[$uuid]['quantidade'] ?? 0) + $request->quantidade;

        $cartItem = [
            'uuid' => $request->cor_codigo.'-'.$estampa_id.'-'.$request->tamanho,
            'nome' => $estampa->nome,
            'cor_codigo' => $request->cor_codigo,
            'estampa_id' => $estampa_id,
            'tamanho' => $request->tamanho,
            'quantidade' => intval($quantidade),
            'preco_un' => floatval(5),
            'subtotal' => floatval(10),
        ];

        $carrinho[$uuid] = $cartItem;

        // create a new Image instance for inserting
       // $watermark = Image::make(public_path('/storage/estampas/38_60b2933a993c7.png'))->resize(216, 231);


       /* Image::make(public_path('/storage/tshirt_base/'.$request->cor_codigo.'.jpg'))->resize(520, 560)
            ->insert($watermark, 'center')
            ->save(public_path('/storage/bbr.jpg'));*/

       // dd(public_path('/storage/logo.png'));

        session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', "Adicionou '$estampa->nome' ao carrinho de compras.")
            ->with('alert-type', 'success');

    }


}
