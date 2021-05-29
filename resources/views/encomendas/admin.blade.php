@extends('layout_admin')
@section('title','Encomendas')
@section('content')
    <div class="row mb-3">
        <div class="col-9">
            <form method="GET" action="#" class="form-group">
                <div class="input-group">
                    <select class="form-control" name="estado" id="idEstado">
                        <option value="show_all" {{$estadoSel == 'show_all' ? 'selected' : ''}}>Mostrar Tudo</option>
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


    {{ $encomendas->withQueryString()->links() }}

@endsection
