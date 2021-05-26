@extends('layout_admin')
@section('title','Alterar Estampa')
@section('content')
    <form method="POST" action="{{route('admin.estampas.update', ['estampa' => $estampa]) }}" class="form-group">
        @csrf
        @method('PUT')
        <div class="estampa-imagem">
            <a>
                <img src="/storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa"
                     class="rounded img-thumbnail">
            </a>
        </div>
        <div>
            <input type="hidden" name="estampa_update"  value="false" />
        </div>
        @include('estampas.partials.admin_create-edit')

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.estampas.edit', ['estampa' => $estampa], ['listaCat' => $listaCat], ['cat' => $cat]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
