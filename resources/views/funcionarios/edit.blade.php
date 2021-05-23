@extends('layout_admin')
@section('title', 'Alterar Funcionário')
@section('content')
    <form method="POST" action="{{route('admin.funcionarios.update', ['funcionario' => $funcionario]) }}" class="form-group"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$funcionario->id}}">
        @include('funcionarios.partials.create-edit')
        @isset($funcionario->foto_url)
            <div class="form-group">
                <img src="{{$funcionario->foto_url ? asset('storage/fotos/' .
                        $funcionario->foto_url) : asset('img/default_img.png') }}"
                     alt="Foto do funcionario" class="img-profile"
                     style="max-width:100%">
            </div>
        @endisset
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.funcionarios.edit', ['funcionario' => $funcionario]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
