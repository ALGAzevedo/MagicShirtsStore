@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper text-center mb-4">
                @if ($categoria->nome)
                    <h1>{{$categoria->nome}} <small>({{$estampas->total()}})</small></h1>
                @else
                    <h1>Catálogo de Estampas</h1>
                @endif
            </div>
        </section>
        <div class="row">

            @include('estampas.partials.categories')

            <div class="col-md-9">

                @include('estampas.partials.list')

            </div> <!-- col.// -->

        </div>

    </div>



@endsection
