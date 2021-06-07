<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Http\Requests\CartRequest;
use App\Http\Traits\TshirtTrait;
use App\Models\Cor;
use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    use TshirtTrait;

    public function index()
    {
        return view('cart.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? [])
            ->with('tamanhos', $this->tshirtSizes())
            ->with('cores', Cor::all());
    }

    private function getPrecoEstampa(Estampa $estampa)
    {
        $precos = Preco::all();

        if ($estampa->cliente_id) {
            return [
                'normal' => $precos[0]->preco_un_proprio,
                'desconto' => $precos[0]->preco_un_proprio_desconto
            ];
        }

        return [
            'normal' => $precos[0]->preco_un_catalogo,
            'desconto' => $precos[0]->preco_un_catalogo_desconto
        ];
    }

    private function getQuantDesconto()
    {
        $precos = Preco::all('quantidade_desconto');
        return intval($precos[0]->quantidade_desconto ?? 0);
    }

    public function update_item(Request $request, string $id)
    {
        return $id;
    }

    public function add(CartRequest $request, Estampa $estampa)
    {


        //Validação
        $request->validated();

        $estampa_id = $estampa->id;
        $uuid = (string)$request->cor_codigo . $estampa_id . $request->tamanho;
        $estampa = Estampa::findOrFail($estampa_id);

        $preco = $this->getPrecoEstampa($estampa);

        $preco_un = $preco['normal'];

        if ($request->quantidade >= $this->getQuantDesconto())
            $preco_un = $preco['desconto'];

        $carrinho = session()->get('carrinho', []);
        $quantidade = ($carrinho[$uuid]['quantidade'] ?? 0) + $request->quantidade;

        $carrinho[$uuid] = [
            'uuid' => $request->cor_codigo . '-' . $estampa_id . '-' . $request->tamanho,
            'nome' => $estampa->nome,
            'cor_codigo' => $request->cor_codigo,
            'estampa_id' => $estampa_id,
            'imagem_url' => $estampa->imagem_url,
            'tamanho' => $request->tamanho,
            'quantidade' => intval($quantidade),
            'preco_un' => floatval($preco_un),
            'subtotal' => floatval($preco_un * $quantidade),
        ];

      /*  if (!Storage::disk('public')->exists('product/')) {
            Storage::disk('public')->makeDirectory('product/');
        }

        //$imagem_tshirt = uniqid('tshirt_').'.jpg';
        $imagem_tshirt = 'tshirt_' . $uuid . '.jpg';

        $watermark = Image::make(public_path('/storage/estampas/' . $estampa->imagem_url))->resize(216, 231);


        Image::make(public_path('/storage/tshirt_base/' . $request->cor_codigo . '.jpg'))->resize(520, 560)
            ->insert($watermark, 'center')
            ->save(public_path('/storage/product/' . $imagem_tshirt));

*/
        session()->put('carrinho', $carrinho);
        session()->put('carrinho_qty', $this->count());
        session()->put('carrinho_subtotal', $this->subtotal());
        return back()
            ->with('alert-msg', "Adicionou '$estampa->nome' ao carrinho de compras.") //TODO: nome com tamanho e cor
            ->with('alert-type', 'success')
            ->withInput();

    }

    public function update(Request $request, string $uuid)
    {

       /* dd(session('carrinho'));
        $validated = $request->validate([
            'cor_codigo' => 'required|exists:cores,codigo',
            'tamanho' => 'required|in:XS,S,M,L,XL',
            'quantidade' => 'required|integer|min:0'
        ], [  // Custom Error Messages
            'cor_codigo.required' => 'Código de cor é um campo obrigatório',
            'cor_codigo.exists' => 'Código de cor inválido',
            'estampa_id.required' => 'estampa_id é um campo obrigatório',
            'estampa_id.exists' => 'estampa_id inválida',
            'tamanho.required' => 'tamanho é um campo obrigatório',
            'tamanho.in' => 'Não é um tamanho válido',
            'quantidade.required' => 'quantidade  é um campo obrigatório',
            'quantidade.min' => 'quantidade  mínima é 1'
        ]);

        dd($validated);*/

        dd("Não funciona");


        $carrinho = session()->get('carrinho', []);

        if (!array_key_exists($uuid, $carrinho)) {
            return back()
                ->with('alert-msg', 'Este produto não se encontra no carrinho!')
                ->with('alert-type', 'warning');
        }

        $item = $carrinho[$uuid];
        $olduuid = $uuid;
        $quantidade = $item['quantidade'] ?? 0;

        //dd($carrinho);

        //TODO: fazer o find da estampa

        $estampa = Estampa::findOrFail($item['estampa_id']);
        $preco = $this->getPrecoEstampa($estampa);
        $preco_un = $preco['normal'];

        if ($request->quantidade >= $this->getQuantDesconto())
            $preco_un = $preco['desconto'];


        if ($request->quantidade < 0 || intval($request->quantidade) == $quantidade) {
            return back();
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' ao produto';
            $quantidade = $request->quantidade;
        }
        if ($request->quantidade <= 0) {
            $msg = 'O produto "' . $item['nome'] . '" foi removido';
            unset($carrinho[$uuid]);

        } else {

            $uuid = (string)$request->cor_codigo . $item['estampa_id'] . $request->tamanho;


            $carrinho[$uuid] = [
                'uuid' => $request->cor_codigo . '-' . $item['estampa_id'] . '-' . $request->tamanho,
                'nome' => $item['nome'],
                'cor_codigo' => $request->cor_codigo ?? $item['cor_codigo'],
                'estampa_id' => $item['estampa_id'],
                'imagem_url' => $estampa->imagem_url,
                'tamanho' => $request->tamanho ?? $item['tamanho'],
                'quantidade' => intval($quantidade),
                'preco_un' => floatval($preco_un),
                'subtotal' => floatval($preco_un * $quantidade),
            ];
            $msg = 'Quantidade atualizada';
        }

        unset($carrinho[$olduuid]);
        session()->put('carrinho', $carrinho);
        session()->put('carrinho_qty', $this->count());
        session()->put('carrinho_subtotal', $this->subtotal());

        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_item(Request $request, string $uuid)
    {
        $carrinho = session()->get('carrinho', []);
        if (array_key_exists($uuid, $carrinho)) {
            unset($carrinho[$uuid]);
            session()->put('carrinho', $carrinho);
            session()->put('carrinho_qty', $this->count());
            session()->put('carrinho_subtotal', $this->subtotal());
            return back()
                ->with('alert-msg', 'Foram removidas todas as inscrições à disciplina')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'Este produto já não se encontra no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function store(Request $request)
    {
        dd(
            'Place code to store the shopping cart / transform the cart into a sale',
            $request->session()->get('carrinho')
        );
    }

    public function destroy(Request $request)
    {
        session()->forget('carrinho');
        session()->forget('carrinho_qty');
        session()->forget('carrinho_subtotal');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

    protected function getContent()
    {
        return Cart::getContent();
    }

    public function count()
    {
        return Cart::total();
    }

    public function subtotal()
    {
        return number_format(Cart::subtotal(), 2, ',', '.');

    }


}
