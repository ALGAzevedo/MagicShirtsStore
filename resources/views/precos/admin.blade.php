@extends('layout_admin')
@section('title','Preços')
@section('content')
    <div class="row mb-3">
        <div class="col-3">
            <a href="{{route('admin.precos.edit', ['precos' =>$precos])}}" class="btn btn-primary">Alterar Preços</a>
        </div>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead class="thead-light">
            <tr>
                <th>Nome</th>
                <th>Preço</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Preco Unitário Catalogo</td>
                <td>{{$precos->preco_un_catalogo}}</td>
            </tr>
            <tr>
                <td>Preco Unitário Estampa Propria</td>
                <td>{{$precos->preco_un_proprio}}</td>
            </tr>
            <tr>
                <td>Preco Unitário Catalogo com Desconto</td>
                <td>{{$precos->preco_un_catalogo_desconto}}</td>
            </tr>
            <tr>
                <td>Preco Unitário Estampa Propria com Desconto</td>
                <td>{{$precos->preco_un_proprio_desconto}}</td>
            </tr>
            <tr>
                <td>Quantidade Minima Para Desconto</td>
                <td>{{$precos->quantidade_desconto}}</td>
            </tr>
            </tbody>

        </table>


        </div>
        </div>
    </div>
@endsection
