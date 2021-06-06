@extends('layout2')
@section('content')
    <div class="container">
        @include('myaccount.partials.title')
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">
                @if (session('alert-msg'))
                    @include('partials.message')
                @endif
                @if ($errors->any())
                    @include('partials.errors')
                @endif
                <div class="card">

                    <header class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <b class="d-inline-block mr-3">Detalhes da Encomenda #{{$encomenda->id}} </b>
                        <span class="badge bg-{{$encomenda->estado}}"> {{$encomenda->estado}}</span>
                    </header>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Facturação</h6>
                                <ul class="list-unstyled mt-2 text-muted">
                                    <li><strong>[{{$encomenda->cliente_id}}] {{$encomenda->Cliente->User->name}}</strong>
                                    </li>
                                    <li>{{$encomenda->endereco}}</li>
                                    @isset($encomenda->notas) <li> Notas:<br> {{$encomenda->notas}} </li>@endisset
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h6>Modo de pagamento:</h6>
                                <ul class="list-unstyled mt-2  text-muted">
                                    <li><strong class="text-dark">{{$encomenda->tipo_pagamento}}:&nbsp; </strong>{{$encomenda->ref_pagamento}}</li>
                                    <li>Total da encomenda: <strong>{{$encomenda->preco_total}}€</strong></li>
                                </ul>
                            </div>
                        </div>

                        <a href="#" class="btn btn-outline-primary">Fatura recibo</a>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-view">
                                <thead>
                                <tr>
                                    <th class="item sortable" colspan="2" >Item</th>
                                    <th class="text-lg-right" >Custo</th>
                                    <th class="text-lg-right" >Qtd</th>
                                    <th class="text-lg-right">Total</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($shirts as $shirt)
                                <tr>
                                    <td width="65" class="cart-item_product">
                                            <div class="shirt_thumb border">
                                                <img
                                                    class="cart-item_product__thumbnail "
                                                    src="{{asset('storage/tshirt_base/' . $shirt->cor_codigo . '.jpg')}}"
                                                    alt="">
                                                <div class="shirt_thumb-overlay">
                                                    <img class="shirt_thumb-overlay-img" src="{{asset('storage/estampas/' . $shirt->Estampa->imagem_url)}}"
                                                         alt="{{$shirt->estampa->nome}}"/>
                                                </div>

                                            </div>
                                    </td>

                                    <td>
                                        <p class="title mb-0">[{{$shirt->estampa->id}}] {{$shirt->estampa->nome}} </p>
                                        <span class="small text-muted">Tamanho: {{$shirt->tamanho}} | Cor: {{$shirt->cor_codigo}}</span>
                                    </td>
                                    <td class="text-lg-right"> {{$shirt->preco_un}}€ </td>
                                    <td class="text-lg-right"> &times;{{$shirt->quantidade}} </td>
                                    <td class="text-lg-right"> {{$shirt->subtotal}}€ </td>
                                </tr>
                                @endforeach


                                </tbody></table>
                        </div>


                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>
@endsection
