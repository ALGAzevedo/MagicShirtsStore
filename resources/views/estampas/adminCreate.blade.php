@extends('layout_admin')
@section('title','Nova Estampa' )
@section('content')
    <form method="POST" action="{{route('admin.estampas.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('estampas.partials.admin_create-edit')
        <div class="form-group">
            <label for="inputEstampa">Upload da estampa</label>
            <input type="file" class="form-control" name="estampa_img" id="inputIMG">
            @error('inputIMG')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div>
            <input type="hidden" name="estampa_update"  value="true" />
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.estampas.create')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
