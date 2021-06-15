<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fatura</title>

    <link rel="stylesheet" href="/css/fatura-styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="grid invoice">
                <div class="grid-body">
                    <div class="invoice-title">
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="{{asset('img/logo-tshirt.png')}}" alt="" height="35">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>Fatura<br>
                                    <span class="small">FTMS/{{$encomenda->id}}</span></h2>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Emitido a:</strong><br>
                                {{$encomenda->cliente->user->name}}<br>
                                {{$encomenda->cliente->endereco}}<br>
                                <strong>NIF </strong>
                                {{$encomenda->nif}}<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Enviado Para:</strong><br>
                                {{$encomenda->cliente->user->name}}<br>
                                {{$encomenda->endereco}}<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Metodo de Pagamento</strong><br>
                                {{$encomenda->tipo_pagamento}} {{$encomenda->ref_pagamento}}<br>
                                {{$encomenda->cliente->user->email}}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Data Encomenda</strong><br>
                                {{$encomenda->data}}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Registo Encomenda</h3>
                            <table class="table table-hover table-view">
                                <thead>
                                <tr>
                                    <th class="item sortable">Item</th>
                                    <th class="text-lg-right">Custo</th>
                                    <th class="text-lg-right">Qtd</th>
                                    <th class="text-lg-right">Total</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($shirts as $shirt)
                                    <tr>
                                        <td>
                                            <p class="title mb-0">{{$shirt->estampa->nome}} </p>
                                            <span
                                                class="small text-muted">Tamanho: {{$shirt->tamanho}} | Cor: {{$shirt->cor->nome}}</span>
                                        </td>
                                        <td class="text-lg-right"> {{$shirt->preco_un}}€</td>
                                        <td class="text-lg-right"> &times;{{$shirt->quantidade}} </td>
                                        <td class="text-lg-right"> {{$shirt->subtotal}}€</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-lg-right"><strong>Total</strong></td>
                                    <td class="text-lg-right"><strong>{{$encomenda->preco_total}}€</strong></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
