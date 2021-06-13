@extends('layout_admin')
@section('title','Nova Estampa' )
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
    <form method="POST" action="{{route('admin.estampas.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('estampas.partials.admin_create-edit')
        <div class="form-group">
            <label for="inputEstampa">Upload da estampa</label>
            <input type="file" class="form-control-file" name="estampa_img" id="inputIMG">
            @error('inputIMG')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div>
            <input type="hidden" name="estampa_update"  value="true" />
        </div>
        <hr>
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a href="{{route('admin.estampas')}}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
