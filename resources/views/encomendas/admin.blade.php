@extends('layout_admin')
@section('title','Encomendas')
@section('content')

    <form method="GET" action="#">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCity">City</label>
                <select class="form-control" name="estado" id="idEstado">
                    @foreach ($listaEstados as $estado)
                        <option value="{{$estado}}" {{$estadoSel == $estado ? 'selected' : ''}}>
                            {{$estado}}
                        </option>
                    @endforeach
                </select>
            </div>
            @can('viewAny', \App\Models\Encomenda::class)
            <div class="form-group col-md-3">
                <label for="inputState">Data</label>
                <input type="date" class="form-control" name="data" value="{{$dataSel}}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">Cliente ID</label>
                <input type="text" class="form-control" name="cliente_id" value="{{$cliente_idSel}}">
            </div>
            @endcan
        </div>
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
