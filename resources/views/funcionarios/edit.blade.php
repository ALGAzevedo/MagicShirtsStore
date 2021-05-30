@extends('layout_admin')
@section('title', 'Alterar Funcionário')
@section('content')
    <form method="POST" action="{{route('admin.funcionarios.update', ['funcionario' => $funcionario]) }}"
          class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$funcionario->id}}">
        @include('funcionarios.partials.create-edit')
        @isset($funcionario->foto_url)
            <div class="form-group">
                <img src="{{$funcionario->foto_url ? asset('storage/fotos/' .
                        $funcionario->foto_url) : asset('img/default_img.png') }}"
                     alt="Foto do funcionario" class="img-profile"
                     style="max-width:10%"
                >
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($funcionario->foto_url)
                <button type="submit" class="btn btn-danger" name="deletefoto"
                        form="form_delete_photo">Apagar Foto
                </button>
            @endisset
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.funcionarios.edit', ['funcionario' => $funcionario]) }}"
               class="btn btn-secondary">Reset</a>
                <!--//TODO: PERGUNTAS  -->
                <a href="{{Auth::user()->tipo == 'A' ? route('admin.funcionarios') : route('admin.dashboard') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('admin.funcionarios.foto.destroy',['funcionario' => $funcionario])}}"
          method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
