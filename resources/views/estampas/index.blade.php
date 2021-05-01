@extends('layout')

@section('content')

<h2>Estampas</h2>
<div class="cursos-area">
    @foreach($estampas as $estampa)

    <div class="curso">
        <div class="curso-imagem">
            <img src="/img/estampas/{{$estampa->imagem_url}}" alt="Imagem da estampa">
        </div>
        <div class="curso-info-area">
            <div class="curso-info">
                <span class="curso-label">Categoria</span>
                <span class="curso-info-desc">{{$estampa->categoriaRef->nome}}</span>
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
