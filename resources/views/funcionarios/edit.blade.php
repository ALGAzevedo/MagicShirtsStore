@extends('layout_admin')
@section('title', 'Alterar Funcionário')
@section('content')
    <div class="card">
        <div class="card-body">
    <form method="POST" action="{{route('admin.funcionarios.update', ['funcionario' => $funcionario]) }}"
          class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$funcionario->id}}">
        <div class="row">
            <div class="col-md-8 col-lg-4 col-xl-4">
        @include('funcionarios.partials.create-edit')
            </div>
            <div class="col-md-4 col-lg-6 col-xl-4">
        @isset($funcionario->foto_url)
            <div class="form-group">
                <img src="{{$funcionario->foto_url ? asset('storage/fotos/' .
                        $funcionario->foto_url) : asset('storage/img/default_img.png') }}"
                     alt="Foto do funcionario" class="img-profile img-fluid" style="max-width: 300px">

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-outline-danger" name="deletefoto"
                        form="form_delete_photo"> <i class="fas fa-trash mr-2"></i> Apagar Foto
                </button>
            </div>

        @endisset
            </div>
        </div>
        <hr>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success btn-block-sm" name="ok">Guardar</button>
            <a href="{{route('admin.funcionarios.edit', ['funcionario' => $funcionario]) }}"
               class="btn btn-secondary btn-block-sm">Reset</a>
                <!--//TODO: PERGUNTAS  -->
                <a href="{{Auth::user()->tipo == 'A' ? route('admin.funcionarios') : route('admin.dashboard') }}" class="btn btn-danger btn-block-sm">Cancelar</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('admin.funcionarios.foto.destroy',['funcionario' => $funcionario])}}"
          method="POST">
        @csrf
        @method('DELETE')
    </form>
        </div>
    </div>
@endsection
