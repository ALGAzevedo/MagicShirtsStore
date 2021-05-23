@extends('layout_admin')
@section('title','Novo Funcionário')
@section('content')
    <form method="POST" action="{{route('admin.funcionarios.store')}}" class="form-group"
          enctype="multipart/form-data">
        @csrf
        @include('funcionarios.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.funcionarios.create')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
