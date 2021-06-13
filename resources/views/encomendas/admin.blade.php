@extends('layout_admin')
@section('title','Encomendas')
@section('content')
    <div class="card">
        <header class="card-header">

    <form method="GET" action="{{route('admin.encomendas')}}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-4 col-lg-2">
                <label for="inputEstado">Estado</label>
                <select class="form-control" name="estado" id="idEstado">
                    @can('viewAny', \App\Models\Encomenda::class)
                        <option value="" {{$estadoSel == "" ? 'selected' : ''}}>Mostrar Tudo</option>
                        <option value="anulada" {{$estadoSel == "anulada" ? 'selected' : ''}}>Anulada</option>
                        <option value="fechada" {{$estadoSel == "fechada" ? 'selected' : ''}}>Fechada</option>
                    @endcan
                    <option value="paga" {{$estadoSel == "paga" ? 'selected' : ''}}>Paga</option>
                    <option value="pendente" {{$estadoSel == "pendente" ? 'selected' : ''}}>Pendente</option>

                </select>
            </div>
            @can('viewAny', \App\Models\Encomenda::class)
                <div class="form-group col-md-4  col-lg-2">
                    <label for="inputState">Data</label>
                    <input type="date" class="form-control" name="data" value="{{$dataSel}}">
                </div>
                <div class="form-group col-md-4  col-lg-2">
                    <label for="inputZip">Cliente ID</label>
                    <input type="text" class="form-control" name="cliente_id" value="{{$cliente_idSel}}">
                </div>
                <div class="form-group col-md-6  col-lg-2">
                    <label for="inputZip">Referencia Pagamento</label>
                    <input type="text" class="form-control" name="referencia_pagamento" value="{{$referencia_pagamentoSel}}">
                </div>
            @endcan

        <div class="form-group col-md-6 col-lg-2">
            <div class="btn-group">
        <a href="{{route('admin.encomendas')}}" class="btn btn-secondary">Reset</a>
        <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
        </div>
    </form>

        </header>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-encomendas">
                    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Estado</th>
            <th colspan="2">Cliente</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($encomendas as $encomenda)
            <tr>

                <td>{{$encomenda->id}}</td>
                <td>{{$encomenda->data}}</td>
                <td><span class="order-status status-{{$encomenda->estado}}"> {{$encomenda->estado}}</span> </td>
                <td>{{$encomenda->cliente_id}}</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('admin.encomendas.edit', ['encomenda' => $encomenda])}}">Detalhes</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $encomendas->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
