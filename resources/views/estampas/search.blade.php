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

                @include('estampas.partials.list')

            </div> <!-- col.// -->

        </div>

    </div>



@endsection
