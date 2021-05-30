@extends('layout2')

@section('content')
    <div class="container">

        <!--Section: Block Content-->
        <section class="mt-5 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Carrinho de compras @if(session()->has('carrinho_qty') && session('carrinho_qty')>0)
                        <small>(<span>{{session('carrinho_qty')}}</span>  @choice('artigo|artigos', session('carrinho_qty')))</small> @endif</h1>
            </div>
            <!--Grid row-->
            <div class="row">
            @if(count($carrinho) > 0)
                <!--Grid column-->
                    <div class="col-lg-8">
                        @if (session('alert-msg'))
                            @include('partials.message')
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
                                                <a href="{{route('tshirts.choose',  $row['estampa_id'])}}/?uuid={{ $row['uuid'] }}"><img
                                                        class="cart-item_product__thumbnail border"
                                                        src="{{asset('storage/tshirt_base/' .$row['cor_codigo'] . '.jpg')}}"
                                                        alt=""></a></td>
                                            <td class="cart-item_product">
                                                <a href="{{route('tshirts.choose',  $row['estampa_id'])}}/?uuid={{ $row['uuid'] }}"
                                                   class="cart-item_product__title text-dark">{{ $row['nome'] }}</a>
                                                <p class="small text-muted">Tamanho: {{ $row['tamanho'] }} </p>
                                                <p class="small text-muted">Cor:
                                                    <select class="form">
                                                        <option>XS</option>
                                                        <option>S</option>
                                                        <option>M</option>
                                                    </select>
                                                </p>
                                                <p class="small text-muted">Tamanho: {{ $row['tamanho'] }}
                                                    <select class="form">
                                                        @foreach ($tamanhos as $tamanho)
                                                        <option value="{{$tamanho}}" {{$row['tamanho'] == $tamanho ? 'checked' : ''}}>{{$tamanho}}</option>
                                                        @endforeach
                                                    </select>
                                                </p>

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
                                                <span class="">{{ number_format($row['subtotal'], 2, ',', '.') }}&euro;</span>

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

                                <form action="{{ route('carrinho.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Finalizar <i
                                            class="far fa-arrow-right ml-1"></i></button>
                                </form>

                            </div>
                        </div>
                        <!-- Card -->

                    </div>
                    <!--Grid column-->
                @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p>O seu carrinho de compras está vazio. <a href="{{route('estampas.index')}}">Continuar a comprar.</a></p>
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
