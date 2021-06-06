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

                            <form method="POST" action="{{route('cliente.estampas.update', ['estampa' => $estampa]) }}" class="form-group">
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

                                <div class="form-group">
                                    <label for="inputNome">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}" />
                                    @error('nome')
                                    <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputDescricao">Descricao</label>
                                    <textarea class="form-control" name="descricao" id="inputDescricao" rows="3">{{old('descricao', $estampa->descricao)}}</textarea>
                                    @error('descricao')
                                    <div class="small text-danger">{{$message}}</div>
                                    @enderror
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
