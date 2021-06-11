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

                @if($estampas->total()>0 )

                    @include('estampas.partials.list')

                @else
                        <div class="card border-0">
                            <div class="card-body p-0 text-center">
                                <div class="empty-state empty-image mx-auto"></div>
                                <h5>As estampas ainda não foram adicionadas</h5>
                            </div>
                        </div>
                @endif

            </div> <!-- col.// -->

        </div>

    </div>



@endsection
