@extends('layout2')

@section('content')

    <section class="my-4">
        <div class="container">
            @unless(is_null($categorias))

            <div class="category-badges-list mb-3">
                @foreach($categorias as $categoria)
                <a class="category-badges-item" href="{{route('estampas.index').'?categoria='.$categoria->id}}">{{$categoria->nome}}</a>
                @endforeach
            </div>
            @endunless

            <div class="intro-banner-wrap">
                <a href="{{route('estampas.index')}}"><img class="lazy img-fluid rounded" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('img/banner-loja.jpg')}}"
                                                           ></a>
            </div>

        </div> <!-- container //  -->
    </section>
    <section class="store-cards my-4">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body border-0 store-card">
                        <span class="text-primary mr-4"><i class="fa-2x fal fa-truck"></i></span>
                        <div class="store-card-info">
                            <h5 class="title">Entregas Rápidas</h5>
                            <p>Entregas em 24h para Portugal Continental e 48h para toda a Europa</p>
                        </div>

                    </div>
                </div><!-- /col -->
                <div class="col-md-4">
                    <div class="card card-body border-0 store-card">
                        <span class="text-primary mr-4"><i class="fal fa-2x fa-box-check"></i></span>
                        <div class="store-card-info">
                            <h5 class="title">Sem mínimos</h5>
                            <p>Não temos mínimos de compra.<br>
                                Temos descontos para quantidades</p>
                        </div>

                    </div>
                </div><!-- /col -->
                <div class="col-md-4">
                    <div class="card card-body border-0 store-card">
                        <span class="text-primary mr-4"><i class="fa-2x fal fa-lock-alt"></i></span>
                        <div class="store-card-info">
                            <h5 class="title">Pagamentos Seguros</h5>
                            <p>Diversos métodos disponíveis.
                                Pagamentos seguros e garantidos
                            </p>
                        </div>

                    </div>
                </div><!-- /col -->

            </div>
        </div> <!-- container .//  -->
    </section>
    <!-- ========================= Popular products ========================= -->

    @unless(is_null($estampas))

    <section class="my-4">
        <div class="container">

            <header class="section-heading d-flex justify-content-between flex-column flex-lg-row align-items-center mb-3 mt-0">
                <h3 class="section-title">Mais Vendidos </h3>
                <a href="{{route('estampas.index')}}" class="btn btn-link text-black-50 btn-sm">Explorar catálogo <i class="fal fa-arrow-right ml-2"></i></a>
            </header><!-- sect-heading -->

            <div class="row">
                @foreach($estampas as $estampa)
                    <div class="col-md-3">
                        <div class="card card-product-grid">
                            <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}">
                                <div class="img-wrap mx-auto">
                                    <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('storage/estampas/'.$estampa->imagem_url)}}" alt="{{$estampa->nome}}">
                                </div></a> <!-- img-wrap.// -->
                            <div class="info-wrap">
                                <div class="fix-height mb-3">
                                   <strong class="text-danger"> {{$estampa->quantity_sold}}</strong>
                                    @unless(is_null($estampa->categoria_id) ) <small class="text-uppercase font-weight-bolder text-secondary small-xs mb-1">{{$estampa->categoriaRef->nome}}</small> @endunless
                                    <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}" class="title mb-1">{{$estampa->nome}}</a>
                                    <small>{{$estampa->descricao}}</small>
                                </div>
                                <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}" class="btn btn-block btn-primary">Ver opções </a>
                            </div>
                        </div>
                    </div> <!-- col.// -->
                @endforeach
            </div> <!-- row end.// -->


        </div> <!-- container .//  -->
    </section>
    @endunless
    <!-- ========================= /Popular products ========================= -->
@endsection
