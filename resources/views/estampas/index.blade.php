@extends('layout')

@section('content')

    <h2>Estampas</h2>
    <form class="estampa-search" action="#" method="GET">
        <div class="search-item">
            <label for="idCat">Categoria:  </label>
            <select name="categoria" id="idCat">
                @foreach ($listaCategorias as $cat)
                    <option value="{{$cat->id}}" {{$categoria->id == $cat->id ? 'selected' : ''}}>
                        {{$cat->nome}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="search-item">
            <button type="submit" class="bt" id="btn-filter">Filtrar</button>
        </div>
    </form>

    <div class="estampa-area">
        @foreach($estampas as $estampa)

            <div class="estampa">
                <div class="estampa-imagem">
                    <img src="storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa">
                </div>
                <div class="estampa-info-area">
                    <div class="estampa-info">
                        <span class="estampa-label">Categoria</span>
                        <span class="estampa-info-desc">{{$categoria->nome}}</span>
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
            </div>
        @endforeach
    </div>

@endsection
