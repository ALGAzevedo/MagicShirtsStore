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
            'categoria_id' => $estampa->categoria_id,
            'imagem_url' => $estampa->imagem_url,
            'tamanho' => $request->tamanho,
            'quantidade' => intval($quantidade),
            'preco_un' => floatval($preco_un),
            'subtotal' => floatval($preco_un * $quantidade),
        ];

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
        //TODO: NÃO É PRECISO FAZER O VALIDATED()???

        $request->validate([
            'cor_codigo' => 'nullable|exists:cores,codigo',
            'tamanho' => 'nullable|in:XS,S,M,L,XL',
            'quantidade' => 'nullable|integer|min:0'
        ], [
            'cor_codigo.exists' => 'Código de cor inválido',
            'tamanho.in' => 'Tamanho inválido.',
            'quantidade.integer' => 'Quantidade inválida.',
            'quantidade.min' => 'Quantidade inválida para atualização.'
        ]);

        $carrinho = session()->get('carrinho', []);

        if (!array_key_exists($uuid, $carrinho)) {
            return back()
                ->with('alert-msg', 'Este produto não se encontra no carrinho!')
                ->with('alert-type', 'warning');
        }

        $item = $carrinho[$uuid];
        $nova_quantidade = $request->quantidade;

        //Atualiza apenas a quantidade
        if ($request->filled('quantidade') && $nova_quantidade <= 0) {
            $this->destroy_item($request, $uuid);
            return back(); // TODO: Estranho o código continuar uma vez que no destroy já tem back()
        }

        //Não atualiza se a quantidade for igual
        if ($nova_quantidade == $item['quantidade']) {
            return back();
        }

        /*
         * Significa que está tudo ok e validado
         * */
        $estampa = Estampa::findOrFail($item['estampa_id']);
        $preco = $this->getPrecoEstampa($estampa);
        $preco_un = $preco['normal'];

        $quantidade = intval($nova_quantidade ?? $item['quantidade']);

        $tamanho = $request->tamanho ?? $item['tamanho'];
        $cor_codigo = $request->cor_codigo ?? $item['cor_codigo'];

        $new_uuid = (string)$cor_codigo . $item['estampa_id'] . $tamanho;

        //Se houver a mesma estampa soma as quantidades
        if ($uuid != $new_uuid) {
            $quantidade += $carrinho[$new_uuid]['quantidade'] ?? 0;
            unset($carrinho[$uuid]); // Elimina a anterior, pois vai ser criada uma nova
        }

        //Aplica o preço com desconto de quantidades
        if ($quantidade >= $this->getQuantDesconto())
            $preco_un = $preco['desconto'];

        //Atualiza dados do carrinho na sessão
        $carrinho[$new_uuid] = [
            'uuid' => $new_uuid,
            'nome' => $item['nome'],
            'cor_codigo' => $cor_codigo,
            'estampa_id' => $item['estampa_id'],
            'categoria_id' => $item['categoria_id'],
            'imagem_url' => $estampa->imagem_url,
            'tamanho' => $tamanho,
            'quantidade' => $quantidade,
            'preco_un' => floatval($preco_un),
            'subtotal' => floatval($preco_un * $quantidade),
        ];

        /*if ($uuid != $new_uuid)
            unset($carrinho[$uuid]);*/

        session()->put('carrinho', $carrinho);
        session()->put('carrinho_qty', $this->count());
        session()->put('carrinho_subtotal', $this->subtotal());

        return back()
            ->with('alert-msg', 'O carrinho de compras foi atualizado')
            ->with('alert-type', 'success');
    }


//TODO: Rename this method to remove()
    public function destroy_item(Request $request, string $uuid)
    {
        $carrinho = session()->get('carrinho', []);
        if (array_key_exists($uuid, $carrinho)) {
            unset($carrinho[$uuid]);
            session()->put('carrinho', $carrinho);
            session()->put('carrinho_qty', $this->count());
            session()->put('carrinho_subtotal', $this->subtotal());
            return back()
                ->with('alert-msg', 'O produto foi removido do carrinho.')
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
