@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Catálogo de Estampas {{$categoria->id}}</h1>
            </div>
        </section>
        <div class="row">
            <main class="col-md-12">
                <header class="mb-3">
                    <form action="#" method="GET">
                        <div class="input-group w-100">
                            <select class="custom-select col-3"  name="categoria" onchange="this.form.submit()">
                                <option value=""  >Todas as Categoria</option>
                                @foreach ($listaCategorias as $cat)
                                    <option value="{{$cat->id}}" {{ $categoria->id == $cat->id ? 'selected' : ''}}>
                                        {{$cat->nome}}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="s" class="form-control" placeholder="Pesquisar estampas por nome ou descrição...">

                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </header><!-- sect-heading -->

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


                <nav class="mt-4" aria-label="Page navigation sample">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>

            </main> <!-- col.// -->

        </div>

    </div>



@endsection
