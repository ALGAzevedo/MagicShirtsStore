<div class="row">
    @foreach($estampas as $estampa)
        <div class="col-md-3">
            <div class="card card-product-grid">
                <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}">
                    <div class="img-wrap mx-auto">
                        <img src="{{asset('storage/estampas/'.$estampa->imagem_url)}}" alt="">
                    </div></a> <!-- img-wrap.// -->
                <div class="info-wrap">
                    <div class="fix-height mb-3">
                        <small class="text-uppercase font-weight-bolder text-secondary small-xs mb-1">{{$estampa->categoriaRef->nome}}</small>
                        <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}" class="title mb-1">{{$estampa->nome}}</a>
                        <small>{{$estampa->descricao}}</small>
                    </div>
                    <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}" class="btn btn-block btn-primary">Ver detalhe </a>
                </div>
            </div>
        </div> <!-- col.// -->
    @endforeach

</div> <!-- row end.// -->

<div class="my-4 mx-auto" >
    {{$estampas->withQueryString()->links()}}
</div>
