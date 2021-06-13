@extends('layout_admin')
@section('title','Novo Funcionário')
@section('content')
    <div class="card">
        <div class="card-body">
    <form method="POST" action="{{route('admin.funcionarios.store')}}" class="form-group"
          enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
        @include('funcionarios.partials.create')
            </div>
        </div>
        <hr>
        <div class="form-group ">
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a href="{{route('admin.funcionarios.create')}}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
        </div>
    </div>
@endsection
