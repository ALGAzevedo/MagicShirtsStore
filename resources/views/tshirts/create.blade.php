@extends('layout2')

@section('content')

    <div class="container">


        <!-- Product section-->
        <section class="py-5">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <div class="col-md-6">
                    <div class="layered-image p-2 bd-highlight">
                        <img class="image-base img-thumbnail"
                             src="{{asset('storage/tshirt_base/' . $corSel->codigo . '.jpg')}}"
                             alt="tshirt base"/>
                        <img class="image-overlay" src="{{asset('storage/estampas/' . $estampa->imagem_url)}}"
                             alt="{{$estampa->nome}}"/>
                    </div>
                </div>
            @csrf
            <!-- route('tshirts.chooseWithColor', ['estampa' => $estampa, 'cor' => $corSel])}} -->

                <div class="filter p-2 flex-grow-1">
                    <form class="cor-search" action="#" method="GET">
                        <div class="search-item">
                            <label for="idCor">Escolha a cor: </label>
                            <select class="form-control" name="cor" id="idCor">
                                @foreach ($listaCores as $cor)
                                    <option
                                        value="{{$cor->codigo}}" {{$corSel->codigo == $cor->codigo ? 'selected' : ''}}>
                                        {{$cor->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <h1 class="display-5 font-weight-bold">{{$estampa->nome}}</h1>
                            <div class="fs-5 mb-3">
                                @if($estampa->client_id)
                                    <h4>{{$preco->preco_un_proprio}}</h4>
                                @else
                                    <h4>{{$preco->preco_un_catalogo}}</h4>
                                @endif
                            </div>
                            <p class="lea">{{$estampa->descricao}}</p>
                            <form action="" method="GET">
                                <!--@csrf-->
                                <div class="form-row">
                                    <div class="col-md-5 my-1">
                                        <label for="idCor">Escolha a cor: </label>
                                        <select class="form-control" name="cor" id="idCor">
                                            @foreach ($listaCores as $cor)
                                                <option
                                                    value="{{$cor->codigo}}" {{$corSel->codigo == $cor->codigo ? 'selected' : ''}}>
                                                    {{$cor->nome}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 my-1">
                                        <label for="selectTamanho">Escolha o tamanho: </label>
                                        <select class="form-control" name="tamanho" id="selectTamanho">
                                            <option>XS</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                    </div>
                                </div><!--/form-row-->
                                <div class="form-row mt-3">
                                    <div class="col-md-3 my-1">
                                        <select class="form-control" name="qty">
                                            @foreach (range(1, 10) as $qty)
                                                <option>{{$qty}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5 my-1">
                                        <button class="btn btn-outline-dark" type="submit">
                                            Selecionar
                                        </button>
                                    </div>
                                </div><!--/form-row-->
                                <hr>
                                <div class="form-row mt-3">
                                    <button class="btn btn-lg btn-primary flex-shrink-0" type="button">
                                        <i class="fas fa-shopping-bag"></i>
                                        Adicionar ao carrinho
                                    </button>
                                </div><!--/form-row-->
                            </form>
                        </div>
                </div>
            </div>
        </section>
    </div>

@endsection
