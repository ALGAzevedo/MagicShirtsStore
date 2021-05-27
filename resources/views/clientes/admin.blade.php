@extends('layout_admin')
@section('title','Clientes' )
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Email</th>
            <th>NIF</th>
            <th>Endereço</th>
            <th>Tipo Pagamento</th>
            <th>Referência de pagamento</th>
            <th>Tipo</th>
            <th>Bloqueado</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr class=table-success'>
                <td>
                    <img
                        src="{{$cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : asset('img/default_img.png') }}"
                        alt="Foto do utilizador" class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{$cliente->user->name}}</td>
                <td>{{$cliente->user->email}}</td>
                <td>{{$cliente->nif}}</td>
                <td>{{$cliente->endereco}}</td>
                <td>{{$cliente->tipo_pagamento}}</td>
                <td>{{$cliente->ref_pagamento}}</td>
                <td>Cliente</td>
                @if($cliente->user->bloqueado == 1)
                    <td>Sim</td>
                @else
                    <td>Não</td>
                @endif

                <td>
                    <a href="{{route('admin.clientes.edit', ['cliente'=> $cliente])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <a href="{{route('admin.clientes.edit', ['cliente'=> $cliente])}}"
                       class="btn btn-warning btn-sm" role="button" aria-pressed="true">Bloquear</a>
                </td>

                <td>
                    <form action="{{route('admin.clientes.destroy', ['cliente' =>$cliente])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $clientes->withQueryString()->links()}}
@endsection
