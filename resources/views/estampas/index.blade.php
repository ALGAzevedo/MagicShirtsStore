@extends('layout')

@section('content')

    <h2>Estampas</h2>
    <form class="disc-search" action="#" method="GET">
        <div class="search-item">
            <label for="idDisc">Categoria:  </label>
            <select name="disc" id="idDisc">
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

    <div class="cursos-area">
        @foreach($estampas as $estampa)

            <div class="curso">
                <div class="curso-imagem">
                    <img src="storage/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa">
                </div>
                <div class="curso-info-area">
                    <div class="curso-info">
                        <span class="curso-label">Categoria</span>
                        <span class="curso-info-desc">{{$estampa->categoriaRef}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Nome</span>
                        <span class="curso-info-desc">{{$estampa->nome}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Descrição</span>
                        <span class="curso-info-desc">{{$estampa->descricao}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
