@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 page-title-wrapper">
                @isset($pageTitle)<h1> {{$pageTitle}} </h1>@endisset
                <a href="{{route('cliente.estampas.create')}}" class="btn btn-info btn-sm">Nova estampa</a>
            </div>
        </section>
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">
                @if (session('alert-msg'))
                    @include('partials.message')
                @endif

                @include('myaccount.partials.list')

            </div> <!-- col.// -->

        </div>

    </div>



@endsection
