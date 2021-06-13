@extends('layout_admin')
@section('title', 'Criar Cor')
@section('content')

    <form method="POST" action="{{route('admin.cores.store', ['cor' => $cor]) }}"
          class="form-group" enctype="multipart/form-data">
        @method('POST')
        @csrf
        @include('cores/partials/create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.cores')}}" class="btn btn-secondary">Cancel</a>
        </div>


@endsection



