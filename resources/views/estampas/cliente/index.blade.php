@extends('layout2')

@section('content')
    <div class="container">
        @include('myaccount.partials.title')
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">

                @if (session('alert-msg'))
                    @include('partials.message')
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3 mt-0">
                    @isset($pageTitle)<h4> {{$pageTitle}} </h4>@endisset
                    <a href="{{route('cliente.estampas.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus pr-1"></i> Nova estampa</a>
                </div>

                @include('myaccount.partials.list')

            </div> <!-- col.// -->

        </div>

    </div>
@endsection
