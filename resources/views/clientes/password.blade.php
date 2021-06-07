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
                    <header class="card-header border-bottom mb-0">
                        <b class="d-inline-block mr-3">Alterar password</b>
                    </header>
                    <div class="card-body">
        <form method="POST" action="{{route('cliente.updatePassword', ['cliente' => $cliente]) }}"
              class="form-group">
            @csrf
            @method('PUT')
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
                <input type="password" class="form-control" name="newPassword_confirmation"
                       id="newPassword_confirmation"
                       value="">
                @error('confirmPassword')
                <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <input type="hidden" name="user_id" value="{{$cliente->id}}">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('cliente.edit', ['cliente'=> $cliente])}}" class="btn btn-danger">Cancel</a>
        </form>
                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>
@endsection
