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
                        <span class="d-inline-block mr-3"><strong>Detalhes da Encomenda #{{$encomenda->id}}</strong></span>
                        <small class="text-muted">Data: {{$encomenda->data}}</small>

                    </header>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 mb-2">
                                <span class="order-status status-{{$encomenda->estado}}"> {{$encomenda->estado}}</span>
                            </div>
                            <div class="col-sm-6">
                                <h6>Facturação</h6>
                                <ul class="list-unstyled mt-2">
                                    <li><strong class="small font-weight-bold text-muted">Cliente:<br> </strong>[{{$encomenda->cliente_id}}] {{$encomenda->Cliente->User->name}}
                                    </li>
                                    <li><strong class="small font-weight-bold text-muted">Endereço:<br></strong>{{$encomenda->endereco}}</li>
                                    @isset($encomenda->notas) <li><strong class="small font-weight-bold text-muted"> Notas:</strong><br> {{$encomenda->notas}} </li>@endisset
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h6>Modo de pagamento:</h6>
                                <ul class="list-unstyled mt-2 ">
                                    <li><strong class="text-dark">{{$encomenda->tipo_pagamento}}:&nbsp; </strong>{{$encomenda->ref_pagamento}}</li>
                                    <li><strong class="font-weight-bold text-muted">Total da encomenda: </strong><br> <strong class="h4 text-dark font-weight-bold">{{$encomenda->preco_total}}€</strong></li>
                                </ul>
                            </div>
                        </div>

                        @if($encomenda->recibo_url != null && $encomenda->estado == "fechada" )
                            <a href="{{$encomenda->recibo_url}}" class="btn btn-info text-uppercase "><i class="fas fa-file-alt mr-2"></i> Fatura recibo</a>
                        @endif

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
                                                    <img class="shirt_thumb-overlay-img" src="{{ static_asset($shirt->estampa->cliente_id,$shirt->estampa->imagem_url)}}"
                                                         alt="{{$shirt->estampa->nome}}"/>
                                                </div>

                                            </div>
                                    </td>

                                    <td>
                                        <p class="title mb-0">[{{$shirt->estampa->id}}] {{$shirt->estampa->nome}} </p>
                                        <span class="small text-muted">Tamanho: {{$shirt->tamanho}} | Código cor: {{$shirt->cor_codigo}}</span>
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
