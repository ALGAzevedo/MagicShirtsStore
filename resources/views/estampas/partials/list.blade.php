<div class="row">
    @foreach($estampas as $estampa)
        <div class="col-md-4">
            <div class="card card-product-grid">
                <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}">
                    <div class="img-wrap mx-auto">
                        <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('storage/estampas/'.$estampa->imagem_url)}}" alt="{{$estampa->nome}}">
                    </div></a> <!-- img-wrap.// -->
                <div class="info-wrap">
                    <div class="fix-height mb-3">
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

<div class="my-4 mx-auto " >
    {{$estampas->withQueryString()->links()}}
</div>
