@extends('layout_admin')
@section('title','Encomendas')
@section('content')
    <div class="row mb-3">
        <div class="col-9">
            <form method="GET" action="#" class="form-group">
                <div class="input-group">
                    <select class="form-control" name="estado" id="idEstado">
                        @foreach ($listaEstados as $estado)
                            <option value="{{$estado}}" {{$estadoSel == $estado ? 'selected' : ''}}>
                                {{$estado}}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($encomendas as $encomenda)
            <tr>

                <td>{{$encomenda->id}}</td>
                <td>{{$encomenda->data}}</td>
                <td>{{$encomenda->estado}}</td>
                <td>
                    <a href="{{route('admin.encomendas.edit', ['encomenda' => $encomenda])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



    {{ $encomendas->withQueryString()->links() }}

@endsection
