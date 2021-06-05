@extends('layout_admin')
@section('title','Encomendas')
@section('content')

    <form method="GET" action="{{route('admin.encomendas')}}">
        <div class="form-row">
            <div class="form-group col-md-2">
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
                <div class="form-group col-md-2">
                    <label for="inputState">Data</label>
                    <input type="date" class="form-control" name="data" value="{{$dataSel}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Cliente ID</label>
                    <input type="text" class="form-control" name="cliente_id" value="{{$cliente_idSel}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Referencia Pagamento</label>
                    <input type="text" class="form-control" name="referencia_pagamento" value="{{$referencia_pagamentoSel}}">
                </div>
            @endcan
        </div>
        <a href="{{route('admin.encomendas')}}" class="btn btn-secondary">Reset</a>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Cliente</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($encomendas as $encomenda)
            <tr>

                <td>
                    <a href="{{route('admin.encomendas.edit', ['encomenda' => $encomenda])}}">{{$encomenda->id}}</a>
                </td>
                <td>{{$encomenda->data}}</td>
                <td>{{$encomenda->estado}}</td>
                <td>{{$encomenda->cliente_id}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $encomendas->withQueryString()->links() }}

@endsection
