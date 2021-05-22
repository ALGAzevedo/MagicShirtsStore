@extends('layout2')

@section('content')
    <div class="container">
        <h2>Estampas</h2>

        <form class="estampa-search" action="#" method="GET">
            <div class="search-item">
                <label for="idCat">Categoria: </label>
                <select class="form-control" name="categoria" id="idCat">
                    @foreach ($listaCategorias as $cat)
                        <option value="{{$cat->id}}" {{$categoria->id == $cat->id ? 'selected' : ''}}>
                            {{$cat->nome}}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="search-item">
                <button type="submit" class="btn btn-secondary">Filtrar</button>
            </div>
        </form>

        <h3>Escolha a estampa</h3>

        <div class="estampa-area">
            @foreach($estampas as $estampa)
                <div class="estampa">
                    <div class="estampa-imagem">
                        <a class="nav-link" href="{{route('encomendas.index',  ['estampa' => $estampa])}}">
                            <img src="storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa"
                                 class="rounded img-thumbnail">
                        </a>
                    </div>
                    <div class="estampa-info-area">
                        <div class="estampa-info">
                            <span class="estampa-label">Categoria</span>
                            <span class="estampa-info-desc">{{$estampa->categoriaRef->nome}}</span>
                        </div>
                        <div class="curso-info">
                            <span class="estampa-label">Nome</span>
                            <span class="estampa-info-desc">{{$estampa->nome}}</span>
                        </div>
                        <div class="curso-info">
                            <span class="estampa-label">Descrição</span>
                            <span class="estampa-info-desc">{{$estampa->descricao}}</span>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="{{$estampa->id}}"
                               value="{{$estampa->id}}" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Selecionar
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    </div>


@endsection
