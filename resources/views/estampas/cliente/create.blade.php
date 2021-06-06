@extends('layout2')
@section('content')
    <div class="container">
        @include('myaccount.partials.title')
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">
                @if ($errors->any())
                    @include('partials.errors')
                @endif
                <div class="card">
                    @isset($pageTitle)
                    <header class="card-header border-bottom">
                        <b class="d-inline-block mr-3">{{$pageTitle}}</b>
                    </header>
                    @endisset
                    <div class="card-body">

                        <form method="POST" action="{{route('cliente.estampas.store')}}"  enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputNome">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}" />
                                    @error('nome')
                                    <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label for="inputDescricao">Descricao</label>
                                    <textarea  class="form-control" name="descricao" id="inputDescricao" rows="3">{{old('descricao', $estampa->descricao)}}</textarea>
                                    @error('descricao')
                                    <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEstampa">Upload da estampa</label>
                                    <input type="file" class="form-control-file estampa-file" name="estampa_img" id="inputIMG">
                                    @error('inputIMG')
                                    <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="estampa_update"  value="true" />

                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="d-flex justify-content-center estampa-preview mx-auto">
                                        <img src="{{asset('img/default_user.jpg')}}" class="img-fluid estampa-preview-img img-thumbnail rounded" alt=""/>
                                    </div>

                                </div>
                            </div><!--/col-->

                            <div class="form-group mb-0 mt-4 col-12">
                                <button type="submit" class="btn btn-success" name="ok">Guardar</button>
                                <a href="{{route('estampas.cliente')}}" class="btn btn-secondary">Cancelar</a>
                            </div>

                            </div><!--/form-row-->

                        </form>

                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>


@endsection