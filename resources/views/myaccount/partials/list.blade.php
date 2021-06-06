<div class="row">
    @foreach($estampas as $estampa)
        <div class="col-md-4">
            <div class="card card-product-grid">

                <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}">
                    <div class="img-wrap mx-auto">
                        <img src="{{asset('storage/estampas/'.$estampa->imagem_url)}}" alt="">
                    </div></a> <!-- img-wrap.// -->
                <div class="info-wrap">
                    <div class="fix-height mb-3">
                        <a href="{{route('tshirts.choose',  ['estampa' => $estampa])}}" class="title mb-1">{{$estampa->nome}}</a>
                        <small>{{$estampa->descricao}}</small>
                    </div>
                    <div class="">
                        <a href="{{route('cliente.estampas.edit', ['estampa' => $estampa])}}"
                           class="btn btn-primary btn-sm d-block mb-2" role="button" aria-pressed="true">Alterar</a>
                        <form action="{{route('cliente.estampas.destroy', ['estampa' => $estampa])}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm d-block w-100" value="Apagar">
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col.// -->
    @endforeach

</div> <!-- row end.// -->

<div class="my-4 mx-auto" >
    {{$estampas->withQueryString()->links()}}
</div>
