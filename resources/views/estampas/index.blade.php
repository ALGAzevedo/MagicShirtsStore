@extends('layout2')

@section('content')
    <div class="container">
        <h2>Estampas</h2>
        <div class="row">

            <div class="filter">
                <form class="cor-search">
                    <div class="search-item">
                        <label for="idCor">Escolha a cor: </label>
                        <select class="form-control" name="cor" id="idCor">
                            @foreach ($listaCores as $cor)
                                <option value="{{$cor->id}}" selected>
                                    {{$cor->nome}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <form class="cor-search">
                    <div class="form-tamanho">
                        <label for="exampleFormControlSelect1">Escolha o tamanho: </label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                </form>
                <label for="quantidade">Quantidade: </label>
                <input class="form-control" type="text" placeholder="Insira quantidade" aria-label="default input example">
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
            </div>

            <div class="estampa-area">
                @foreach($estampas as $estampa)
                    <div class="estampa">
                        <div class="estampa-imagem">
                            <img src="storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa"
                                 class="rounded img-thumbnail">
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
                            <input class="form-check-input" type="radio" name="exampleRadios" id="{{$estampa->id}}" value="{{$estampa->id}}" checked>
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
