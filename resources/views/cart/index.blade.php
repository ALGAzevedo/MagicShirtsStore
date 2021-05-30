@extends('layout2')

@section('content')
    <div class="container">

        <!--Section: Block Content-->
        <section class="mt-5 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Carrinho de compras <small>(<span>x</span> artigos)</small></h1>
            </div>
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-8">
                    <div class="alert alert-success mb-3">
                        <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                    </div>
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
                                @foreach ($carrinho as $row)
                                <tbody>
                                <tr class="cart-item">
                                    <td class="cart-item_product">
                                        <a href="{{route('tshirts.choose',  $row['estampa_id'])}}/?uuid={{ $row['uuid'] }}"><img class="cart-item_product__thumbnail border" src="{{asset('storage/tshirt_base/' .$row['cor_codigo'] . '.jpg')}}"
                                                         alt=""></a></td>
                                    <td class="cart-item_product">
                                        <a href="{{ route('carrinho.update_item',$row['uuid']) }}" class="cart-item_product__title text-dark">{{ $row['nome'] }}</a>
                                        <p class="small text-muted">Tamanho: {{ $row['tamanho'] }} </p>

                                    </td>
                                    <td class="cart-item_price">{{ $row['preco_un'] }}</td>
                                    <td>
                                        <div class="number-input number-input-sm">
                                            <button type="button"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                    class="minus font-weight-bold">-
                                            </button>
                                            <input class="quantity" min="0" max="100" name="quantity" value="{{ $row['quantidade'] }}"
                                                   type="number">
                                            <button type="button"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                    class="plus font-weight-bold">+
                                            </button>
                                        </div>
                                    </td>
                                    <td class="cart-item_subtotal ">
                                        <span class="">{{ $row['subtotal'] }}</span>

                                    </td>
                                    <td class="cart-item_action"><a href="#" class="cart-item_action__remove"><i
                                                class="far fa-times mr-1"></i></a></td>
                                </tr>

                                </tbody>
                                @endforeach

                            </table>

                            <div class="card-body border-top cart-footer">
                                <div class="row no-gutters align-items-center">

                                    <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                        <a href="#" class="btn btn-light "><i class="fas fa-arrow-left mr-1"></i> Continuar
                                            a comprar</a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 text-left text-md-right">
                                        <a href="#" class="btn btn-link"><i class="fas fa-trash mr-1"></i> Esvaziar carrinho</a>
                                        <a href="#" class="btn btn-link"><i class="fas fa-redo mr-1"></i> Atualizar carrinho</a>
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
                                    <span>59,95€</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                    Entrega
                                    <span>Gratis</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Valor a pagar </strong>
                                    </div>
                                    <span><strong>59,95€</strong></span>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-lg btn-primary btn-block">Finalizar <i
                                    class="far fa-check ml-1"></i></button>


                        </div>
                    </div>
                    <!-- Card -->

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Block Content-->

    </div>
@endsection
