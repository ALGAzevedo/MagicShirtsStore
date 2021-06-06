@extends('layout2')
@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                @isset($pageTitle)  <h1> {{$pageTitle}}</h1> @endisset
            </div>
        </section>
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">

                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            @include('partials.errors')
                        @endif

                        <form method="POST" action="{{route('cliente.estampas.store')}}" class="form-group" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="inputNome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}" />
                                @error('nome')
                                <div class="small text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                @error('categoria')
                                <div class="small text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputDescricao">Descricao</label>
                                <input type="text" class="form-control" name="descricao" id="inputDescricao" value="{{old('descricao', $estampa->descricao)}}" />
                                @error('descricao')
                                <div class="small text-danger">{{$message}}</div>
                                @enderror
                            </div>
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
                                <a href="{{route('estampas.cliente')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>


@endsection
