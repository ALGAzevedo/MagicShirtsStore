@extends('layout_admin')
@section('title','Estado Encomenda')
@section('content')


    <div class="container">
        <div class="col-10">
            <table>
                <tbody>
                <tr>
                    <th>Cliente</th>
                    <td>[{{$encomenda->cliente_id}}] {{$encomenda->Cliente->User->name}}</td>
                </tr>
                <tr>
                    <th>Tipo Pagamento</th>
                    <td>{{$encomenda->tipo_pagamento}}</td>
                </tr>
                <tr>
                    <th>Referencia Pagamento</th>
                    <td>{{$encomenda->ref_pagamento}}</td>
                </tr>
                <tr>
                    <th>Preço Total Encomenda</th>
                    <td>{{$encomenda->preco_total}}€</td>
                </tr>
                <tr>
                    <th>Notas</th>
                    <td>{{$encomenda->notas}}</td>
                </tr>
                <tr>
                    <th>Endereço</th>
                    <td>{{$encomenda->endereco}}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
    <hr>
    <div class="container my-5">
        @foreach ($shirts as $shirt)
            <div class="row pt-4">
                <div class="col-9">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Estampa</th>
                            <td>[{{$shirt->estampa->id}}] {{$shirt->estampa->nome}}</td>
                        </tr>
                        <tr>
                            <th>Cor Codigo</th>
                            <td>{{$shirt->cor_codigo}}</td>
                        </tr>
                        <tr>
                            <th>Tamanho</th>
                            <td>{{$shirt->tamanho}}</td>
                        </tr>
                        <tr>
                            <th>Quantidade</th>
                            <td>{{$shirt->quantidade}}</td>
                        </tr>
                        <tr>
                            <th>Preço</th>
                            <td>{{$shirt->preco_un}}</td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <div class="layered-image">
                        <img class="image-base img-thumbnail"
                             src="{{asset('storage/tshirt_base/' . $shirt->cor_codigo . '.jpg')}}"
                             alt="tshirt base"/>
                        <img class="image-overlay" src="{{asset('storage/estampas/' . $shirt->Estampa->imagem_url)}}"
                             alt=""/>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{route('admin.encomendas.update', ['encomenda' => $encomenda])}}">
        @csrf
        @method('PUT')
        <div class="form-group text-right">
            @isset($estadoSeguinte)
                <?php $botao = $estadoSeguinte == "paga" ? "Declarar como Paga" : "Declarar como Fechada" ?>

                <button type="submit" class="btn btn-success" name="estado"
                        value="{{$estadoSeguinte}}">{{$botao}}</button>
            @endisset
            @can('updateAnular', \App\Models\Encomenda::class)
                <button type="submit" class="btn btn-danger" name="estado" value="anulada">Anular Encomenda</button>
            @endcan
            <a href="{{route('admin.encomendas')}}"
               class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
