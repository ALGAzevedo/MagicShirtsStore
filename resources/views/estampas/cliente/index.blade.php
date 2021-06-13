@extends('layout2')

@section('content')
    <div class="container">
        @include('perfil.partials.title')
        <div class="row">

            @include('perfil.partials.sidebar')

            <div class="col-md-9">

                @if (session('alert-msg'))
                    @include('partials.message')
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3 mt-0">
                    @isset($pageTitle)<h4> {{$pageTitle}} </h4>@endisset
                    <a href="{{route('cliente.estampas.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus pr-1"></i> Nova estampa</a>
                </div>

                    @if($estampas->total()>0 )

                        @include('perfil.partials.list')

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
