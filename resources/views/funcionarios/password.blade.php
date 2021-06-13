@extends('layout_admin')
@section('title', 'Alterar Password')
@section('content')
    <div class="card">
        <div class="card-body">
    <form method="POST" action="{{route('admin.funcionarios.updatePassword', ['funcionario' => $funcionario]) }}"
          class="form-group">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 col-lg-4 col-xl-4">
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
            <label for="inputPassword">Password Antiga</label>
            <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                   value="">
            @error('oldPassword')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputPassword">Nova Password</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword"
                   value="">
            @error('newPassword')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputPassword">Confirme a Password</label>
            <input type="password" class="form-control" name="newPassword_confirmation" id="newPassword_confirmation"
                   value="">
            @error('confirmPassword')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
            </div>
        </div>
            <hr>
            <div class="form-group">
        <input type="hidden" name="user_id" value="{{$funcionario->id}}">
        <button type="submit" class="btn btn-success btn-block-sm" name="ok">Guardar</button>
        <a href="{{route('admin.dashboard')}}" class="btn btn-danger btn-block-sm">Cancelar</a>
      </div>
    </form>
        </div>
    </div>
@endsection
