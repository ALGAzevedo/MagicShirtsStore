@extends('layout_admin')
@section('title', 'Alterar Password')
@section('content')
    <form method="POST" action="{{route('admin.funcionarios.updatePassword', ['funcionario' => $funcionario]) }}"
          class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" class="form-control" name="name" id="inputNome"
                   @cannot('update',$funcionario) readonly @endcannot
                   value="{{old('name', $funcionario->name)}}">
            @error('name')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail"
                   @cannot('update',$funcionario) readonly @endcannot
                   value="{{old('email', $funcionario->email)}}">
            @error('email')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" name="password" id="password"
                   value="">
            @error('password')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <input type="hidden" name="user_id" value="{{$funcionario->id}}">
        @include('funcionarios.partials.create-edit')
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <!--//TODO: PERGUNTAS  -->
        <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('admin.funcionarios.foto.destroy',['funcionario' => $funcionario])}}"
          method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
