@extends('layout_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
        <form method="POST" action="{{route('admin.encomendas.update', ['encomenda' => $encomenda])}}">
            @csrf
            @method('PUT')
            <div class="form-group text-right">
                @isset($estadoSeguinte)
                    <?php $botao = $estadoSeguinte == "paga" ? "Declarar como Paga" : "Declarar como Fechada" ?>

                    <button type="submit" class="btn btn-sm btn-success" name="estado"
                            value="{{$estadoSeguinte}}">{{$botao}}</button>
                @endisset
                @can('updateAnular', \App\Models\Encomenda::class)
                    <button type="submit" class="btn btn-sm btn-danger" name="estado" value="anulada">Anular Encomenda</button>
                @endcan
                <a href="{{route('admin.encomendas')}}"
                   class="btn btn-sm btn-secondary">Cancel</a>
            </div>
        </form>
        </div>
    </div></div>
    @include('encomendas.partials.view-edit');

@endsection
