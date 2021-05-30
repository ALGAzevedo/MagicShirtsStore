<?php

namespace App\Http\Controllers;

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

    public function add(CartRequest $request)
    {
        //Validação
        $request->validated();

        $estampa_id = $request->estampa_id;
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
            'tamanho' => $request->tamanho,
            'quantidade' => intval($quantidade),
            'preco_un' => floatval($preco_un), /*TODO: get real product price*/
            'subtotal' => floatval($preco_un * $quantidade),
        ];

        if (!Storage::disk('public')->exists('product/')) {
            Storage::disk('public')->makeDirectory('product/');
        }

        //$imagem_tshirt = uniqid('tshirt_').'.jpg';
        $imagem_tshirt = 'tshirt_' . $uuid . '.jpg';

        $watermark = Image::make(public_path('/storage/estampas/' . $estampa->imagem_url))->resize(216, 231);


        Image::make(public_path('/storage/tshirt_base/' . $request->cor_codigo . '.jpg'))->resize(520, 560)
            ->insert($watermark, 'center')
            ->save(public_path('/storage/product/' . $imagem_tshirt));


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
        $carrinho = session()->get('carrinho', []);

        if (!array_key_exists($uuid, $carrinho)) {
            return back()
                ->with('alert-msg', 'Este produto não se encontra no carrinho!')
                ->with('alert-type', 'warning');
        }

        $item = $carrinho[$uuid];
        $quantidade = $item['quantidade'] ?? 0;

        dd($carrinho);

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
            $msg = 'Foram removidas todas as inscrições à disciplina "' . $item['nome'] . '"';
            unset($carrinho[$uuid]);

        } else {
            //Atualiza apenas o que é necessário
            $carrinho[$uuid] = [
                'uuid' => $item['uuid'],
                'nome' => $item['nome'],
                'cor_codigo' => $item['cor_codigo'],
                'estampa_id' => $item['estampa_id'],
                'tamanho' => $item['tamanho'],
                'quantidade' => intval($quantidade),
                'preco_un' => floatval($preco_un), /*TODO: get real product price*/
                'subtotal' => floatval($preco_un * $quantidade), /*TODO: get real product price*/
            ];
            $msg = 'Quantidade atualizada';
        }
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
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

    protected function getContent()
    {
        return session()->has('carrinho')
            ? collect(session()->get('carrinho'))
            : new Collection;
    }

    public function count()
    {
        $content = $this->getContent();
        return $content->sum('quantidade');
    }

    public function subtotal()
    {
        $content = $this->getContent();
        return number_format($content->sum('subtotal'), 2, ',', '.');

    }


}
