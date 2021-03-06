@extends('layout2')

@section('content')
    <div class="container">

        <!--Section: Block Content-->
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Carrinho de compras @if(session()->has('carrinho_qty') && session('carrinho_qty')>0)
                        <small>(<span>{{session('carrinho_qty')}}</span> @choice('artigo|artigos', session('carrinho_qty'))
                            )</small> @endif</h1>
            </div>
            <!--Grid row-->
            <div class="row">
            @if(count($carrinho) > 0)
                <!--Grid column-->
                    <div class="col-lg-8">
                        @if (session('alert-msg'))
                            @include('partials.message')
                        @endif
                        @if ($errors->any())
                            @include('partials.errors')
                        @endif
                        <div class="card mb-4">
                            <div class="table-responsive">
                                <table class="table table-borderless table-cart">
                                    <thead>
                                    <tr class="small text-uppercase text-muted">

                                        <th colspan="2">Produto</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    @foreach ($carrinho as $key=>$row)
                                        <tbody>
                                        <tr class="cart-item">
                                            <td class="cart-item_product">
                                                <a href="{{route('tshirts.choose',  $row['estampa_id'])}}">
                                                    <div class="shirt_thumb border">
                                                        <img
                                                            class="cart-item_product__thumbnail img-{{$key}}"
                                                            src="{{asset('storage/tshirt_base/' .$row['cor_codigo'] . '.jpg')}}"
                                                            alt="">
                                                        <div class="shirt_thumb-overlay">
                                                            <img class="shirt_thumb-overlay-img"
                                                                 src="{{static_asset($row['cliente_id'],$row['imagem_url'])}}"
                                                                 alt="{{$row['nome']}}"/>
                                                        </div>

                                                    </div>
                                                </a>
                                            </td>
                                            <td class="cart-item_product px-0">
                                                <a href="{{route('tshirts.choose',  $row['estampa_id'])}}"
                                                   class="cart-item_product__title text-dark ">{{ $row['nome'] }}</a>
                                                <form action="{{route('carrinho.update', $key)}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="quantidadev"
                                                           value="{{$row['quantidade']}}">
                                                    <p class="small text-muted">
                                                        <select class="form color-{{$key}}" name="cor_codigo"
                                                                onchange="this.form.submit()">
                                                            @foreach ($cores as $cor)
                                                                <option
                                                                    value="{{$cor->codigo}}" {{$row['cor_codigo'] == $cor->codigo ? 'selected' : ''}}>
                                                                    {{$cor->nome}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p class="small text-muted">Tamanho:<br>
                                                        <select class="form" name="tamanho"
                                                                onchange="this.form.submit()">
                                                            @foreach ($tamanhos as $tamanho)
                                                                <option
                                                                    value="{{$tamanho}}" {{$row['tamanho'] == $tamanho ? 'selected' : ''}}>{{$tamanho}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </form>

                                            </td>
                                            <td class="cart-item_price">{{ $row['preco_un'] }}&euro;</td>
                                            <td>
                                                <form action="{{route('carrinho.update', $key)}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="d-flex align-items-center">
                                                        <div class="number-input number-input-sm">
                                                            <button type="button"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                                    class="minus font-weight-bold">-
                                                            </button>
                                                            <input class="quantity" min="0" max="100"
                                                                   name="quantidade"
                                                                   value="{{ $row['quantidade'] }}"
                                                                   type="number">
                                                            <button type="button"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                                    class="plus font-weight-bold">+
                                                            </button>
                                                        </div>
                                                        <div class="form-xw">
                                                            <button type="submit" class="btn btn-light  ml-2">
                                                                <i class="fas fa-redo m-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="cart-item_subtotal text-primary ">
                                                <span
                                                    class="">{{ number_format($row['subtotal'], 2, ',', '.') }}&euro;</span>

                                            </td>
                                            <td class="cart-item_action">
                                                <form action="{{route('carrinho.destroy_item', $key)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-light"><i
                                                            class="fas fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        </tbody>
                                    @endforeach

                                </table>

                                <div class="card-body border-top cart-footer">
                                    <div class="row no-gutters align-items-center">

                                        <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                            <a href="{{route('estampas.index')}}" class="btn btn-light">
                                                <i class="fas fa-arrow-left mr-1"></i>
                                                Continuar a comprar</a>
                                        </div>
                                        <div class="col-lg-8 col-md-6 text-left text-md-right">

                                            <form action="{{route('carrinho.destroy')}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-link text-danger">
                                                    <i class="fas fa-trash mr-1"></i> Esvaziar carrinho
                                                </button>
                                            </form>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- /Card -->

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4">

                        <!-- Card -->
                        <div class="card mb-4">
                            <div class="card-body">

                                <h5 class="mb-3">Resumo do pedido</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Subtotal:
                                        <span>{{session('carrinho_subtotal')}}€</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                        Entrega
                                        <span>Gratis</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Valor a pagar </strong>
                                        </div>
                                        <span><strong>{{session('carrinho_subtotal')}}€</strong></span>
                                    </li>
                                </ul>

                                <a href="{{ route('checkout.index') }}" class="btn btn-lg btn-primary btn-block">Checkout<i
                                        class="far fa-arrow-right ml-2"></i></a>

                            </div>
                        </div>
                        <!-- Card -->

                    </div>
                    <!--Grid column-->
                @else
                    <div class="col-md-12">
                        <div class="card border-0">
                            <div class="card-body  text-center">
                                <div class="empty-state empty-cart mx-auto"></div>
                                <h5> O seu carrinho de compras está vazio.</h5>
                                <p>Descubra o nosso <a href="{{route('estampas.index')}}">catálogo de estampas </a> ou
                                    veja as nossas promoções.</p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Block Content-->

    </div>
@endsection
