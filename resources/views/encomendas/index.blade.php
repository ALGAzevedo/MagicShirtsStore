@extends('layout2')

@section('content')
    <form method="GET" action="{{route('cliente.encomendas')}}">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEstado">Estado</label>
                <select class="form-control" name="estado" id="idEstado">
                    <option value="" {{$estadoSel == "" ? 'selected' : ''}}>Mostrar Tudo</option>
                    <option value="anulada" {{$estadoSel == "anulada" ? 'selected' : ''}}>Anulada</option>
                    <option value="fechada" {{$estadoSel == "fechada" ? 'selected' : ''}}>Fechada</option>
                    <option value="paga" {{$estadoSel == "paga" ? 'selected' : ''}}>Paga</option>
                    <option value="pendente" {{$estadoSel == "pendente" ? 'selected' : ''}}>Pendente</option>

                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputState">Data</label>
                <input type="date" class="form-control" name="data" value="{{$dataSel}}">
            </div>
        </div>
        <a href="{{route('cliente.encomendas')}}" class="btn btn-secondary">Reset</a>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($encomendas as $encomenda)
            <tr>

                <td>
                    <a href="{{route('cliente.encomenda.view', ['encomenda' => $encomenda])}}">{{$encomenda->id}}</a>
                </td>
                <td>{{$encomenda->data}}</td>
                <td>{{$encomenda->estado}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
