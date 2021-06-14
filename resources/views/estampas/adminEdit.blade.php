@extends('layout_admin')
@section('title','Alterar Estampa')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 col-lg-4 col-xl-4">
                    <form method="POST" action="{{route('admin.estampas.update', ['estampa' => $estampa]) }}"
                          class="form-group">
                        @csrf
                        @method('PUT')
                        <div class="estampa-imagem form-group">
                            <a>
                                <img src="/storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa"
                                     class="rounded img-thumbnail img-fluid w-100" style="max-width: 20rem">
                            </a>
                        </div>
                        <div>
                            <input type="hidden" name="estampa_update" value="false"/>
                        </div>
                        @include('estampas.partials.admin_create-edit')
                        <hr>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
                            <a href="{{route('admin.estampas.edit', ['estampa' => $estampa], ['listaCat' => $listaCat], ['cat' => $cat]) }}"
                               class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
