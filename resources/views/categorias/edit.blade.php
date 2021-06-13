@extends('layout_admin')
@section('title','Alterar Categoria' )
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 col-lg-4 col-xl-4">
    <form method="POST" action="{{route('admin.categorias.update', ['categoria' => $categoria]) }}" class="form-group">
        @csrf
        @method('PUT')

        @include('categorias.partials.create-edit')
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block-sm" name="ok">Guardar</button>
            <a href="{{route('admin.categorias.edit', ['categoria' => $categoria])}}" class="btn btn-primary btn-block-sm">Reset</a>
            <a href="{{route('admin.categorias')}}" class="btn btn-secondary btn-block-sm">Cancelar</a>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
