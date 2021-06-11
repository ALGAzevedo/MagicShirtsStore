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
                @if ($errors->any())
                    @include('partials.errors')
                @endif
                <div class="card">
                        <header class="card-header border-bottom mb-3">
                            <b class="d-inline-block mr-3">Alterar dados de cliente</b>

                        </header>
                    <div class="card-body">
                        @isset($cliente->user->foto_url)
                            <div class="form-group u-profile-img">
                                <img src="{{$cliente->user->foto_url ? asset('storage/fotos/' .
                        $cliente->user->foto_url) : asset('img/default_img.png') }}" class="img-sm rounded-circle border">
                                <span class="u-profile-remove-img">
                                    <button type="submit" class="btn p-0 btn-group text-white" name="deletefoto"
                                            form="form_delete_photo"><i class="fas fa-trash"></i>
                                    </button>
                                    </span>
                            </div>
                        @endisset
                        <form method="POST" action="{{route('cliente.update', ['cliente' => $cliente]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{$cliente->id}}">

                            @include('clientes.partials.create-edit')
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-success btn-block-sm" name="ok">Guardar</button>
                                <a href="{{route('home') }}" class="btn btn-danger btn-block-sm">Cancelar</a>
                            </div>
                        </form>
                        <form id="form_delete_photo"
                              action="{{route('cliente.foto.destroy',['cliente' => $cliente])}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>
@endsection
