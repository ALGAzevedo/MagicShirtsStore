@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper text-center mb-4">
                <h1>Pesquisou por "<strong>{{old('s')}}</strong>"</h1>
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
                                <div class="empty-state empty-search mx-auto"></div>
                                <h5>Infelizmente, a tua pesquisa por <span class="text-primary"> "{{old('s')}}"</span> não deu nenhum resultado.</h5>
                                <p>Tenta novamente com um termo diferente
                                </p>
                            </div>
                        </div>
                @endif

            </div> <!-- col.// -->

        </div>

    </div>



@endsection
