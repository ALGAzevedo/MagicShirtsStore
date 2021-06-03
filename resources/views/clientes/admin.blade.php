@extends('layout_admin')
@section('title','Clientes' )
@section('content')

    <form method="GET" action="{{route('admin.funcionarios')}}" class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputBloqueado">Bloqueado</label>
                        <div class="input-group">
                            <select class="form-control" name="bloqueado" id="inputBloqueado">
                                <option value="">Todos</option>
                                <option value="1">Bloqueados</option>
                                <option value="0">Não Bloqueados</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputTipoPagamento">Tipo Pagamento</label>
                        <div class="input-group">
                            <select class="form-control" name="tipoPagamento" id="inputTipoPagamento">
                                <option value="">Todos</option>
                                <option value="MC">MC</option>
                                <option value="PAYPAL">PAYPAL</option>
                                <option value="VISA">VISA</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-9">
                        <label for="inputNome">Nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" id="inputNome" value="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputEmail">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" id="inputNome" value="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputNif">NIF</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nif" id="inputNif" value="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputEndereco">Endereço</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="endereco" id="inputEndereco" value="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-9">
                        <label for="inputReferencia">Referência Pagamento</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="ref_pagamento" id="inputReferencia" value="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>
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
                        <form method="POST" action="{{route('admin.clientes.block', ['cliente' => $cliente]) }}"
                              class="form-group" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if($cliente->user->bloqueado == 0)
                                <button type="submit" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                    Bloquear
                                </button>
                            @else
                                <button type="submit" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                    Desbloquear
                                </button>
                            @endif
                        </form>
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
