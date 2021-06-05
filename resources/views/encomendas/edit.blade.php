@extends('layout_admin')
@section('title','Estado Encomenda')
@section('content')


    @include('encomendas.partials.view-edit');

    <form method="POST" action="{{route('admin.encomendas.update', ['encomenda' => $encomenda])}}">
        @csrf
        @method('PUT')
        <div class="form-group text-right">
            @isset($estadoSeguinte)
                <?php $botao = $estadoSeguinte == "paga" ? "Declarar como Paga" : "Declarar como Fechada" ?>

                <button type="submit" class="btn btn-success" name="estado"
                        value="{{$estadoSeguinte}}">{{$botao}}</button>
            @endisset
            @can('updateAnular', \App\Models\Encomenda::class)
                <button type="submit" class="btn btn-danger" name="estado" value="anulada">Anular Encomenda</button>
            @endcan
            <a href="{{route('admin.encomendas')}}"
               class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
