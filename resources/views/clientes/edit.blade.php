@extends('layout_admin')
@section('title', 'Alterar Cliente')
@section('content')
    <form method="POST" action="{{route('admin.clientes.update', ['cliente' => $cliente]) }}"
          class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$cliente->id}}">
        @include('clientes.partials.create-edit')
        @isset($cliente->user->foto_url)
            <div class="form-group">
                <img src="{{$cliente->user->foto_url ? asset('storage/fotos/' .
                        $cliente->user->foto_url) : asset('img/default_img.png') }}"
                     alt="Foto do cliente" class="img-profile"
                     style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($cliente->user->foto_url)
                <button type="submit" class="btn btn-danger" name="deletefoto"
                        form="form_delete_photo">Apagar Foto
                </button>
            @endisset
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a href="{{route('admin.clientes.edit', ['cliente' => $cliente]) }}"
               class="btn btn-secondary">Reset</a>
            <a href="{{route('admin.clientes') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('admin.clientes.foto.destroy',['cliente' => $cliente])}}"
          method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
