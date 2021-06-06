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
                        <header class="card-header border-bottom d-flex justify-content-between align-items-center mb-3">
                            <b class="d-inline-block mr-3">Alterar dados de cliente</b>
                            @can('updatePassword', $cliente)
                                    <a href="{{route('cliente.password.update', ['cliente' => $cliente]) }}"
                                       class="btn btn-dark btn-sm">Alterar Password</a>
                            @endcan
                        </header>
                    <div class="card-body">
                        @isset($cliente->user->foto_url)
                            <div class="form-group u-profile-img">
                                <img src="{{$cliente->user->foto_url ? asset('storage/fotos/' .
                        $cliente->user->foto_url) : asset('img/default_img.png') }}" class="img-sm rounded-circle border">
                                <span class="u-profile-remove-img"><i class="fas fa-trash"></i></span>
                            </div>
                        @endisset
                        <form method="POST" action="{{route('cliente.update', ['cliente' => $cliente]) }}"
                              class="form-group" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{$cliente->id}}">

                            @include('clientes.partials.create-edit')
                            <div class="form-group text-right">
                                @isset($cliente->user->foto_url)
                                    <button type="submit" class="btn btn-danger" name="deletefoto"
                                            form="form_delete_photo">Apagar Foto
                                    </button>
                                @endisset
                                <button type="submit" class="btn btn-success" name="ok">Save</button>
                                <a href="{{route('cliente.edit', ['cliente' => $cliente]) }}"
                                   class="btn btn-secondary">Reset</a>
                                <a href="{{route('home') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                        <form id="form_delete_photo"
                              action="{{route('admin.clientes.foto.destroy',['cliente' => $cliente])}}"
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
