@extends('layout_admin')
@section('title', 'Criar Cor')
@section('content')
    <div class="card">
        <div class="card-body">
    <form method="POST" action="{{route('admin.cores.store', ['cor' => $cor]) }}"
          class="form-group" enctype="multipart/form-data">
        @method('POST')
        @csrf
        @include('cores/partials/create-edit')
        <hr>
        <div class="form-group ">
            <button type="submit" class="btn btn-success btn-block-sm" name="ok">Guardar</button>
            <a href="{{route('admin.cores')}}" class="btn btn-secondary btn-block-sm">Cancelar</a>
        </div>
    </form>
        </div>
    </div>
@endsection



