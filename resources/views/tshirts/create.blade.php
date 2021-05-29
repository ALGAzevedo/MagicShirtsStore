@extends('layout2')

@section('content')

    <div class="container">
        <!-- Product section-->
        <section class="py-5">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <div class="col-md-6">
                    <div class="layered-image p-2 bd-highlight">
                        <img class="image-base img-thumbnail magic-shirt"
                             src="{{asset('storage/tshirt_base/' . $corSel->codigo . '.jpg')}}"
                             alt="tshirt base"/>
                        <img class="image-overlay" src="{{asset('storage/estampas/' . $estampa->imagem_url)}}"
                             alt="{{$estampa->nome}}"/>
                    </div>
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
                    <div class="form-row mb-3">
                        <div class="col-md-5 my-1">
                            <label for="idCor" class="text-muted">Escolha a cor: </label>
                            <select class="form-control magic-color" name="cor" id="idCor">
                                @foreach ($listaCores as $cor)
                                    <option
                                        value="{{$cor->codigo}}" {{$corSel->codigo == $cor->codigo ? 'selected' : ''}}>
                                        {{$cor->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>{{--/form-row--}}
                    <div class="form-group mb-3">
                        <label class="text-muted">Tamanhos</label>
                        <div class="btn-groupx btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-size">
                                <input type="radio" name="size" value="xs" autocomplete="off"> XS
                            </label>
                            <label class="btn btn-size active">
                                <input type="radio" name="size" value="s" autocomplete="off" checked> S
                            </label>
                            <label class="btn btn-size">
                                <input type="radio" name="size" value="m" autocomplete="off"> M
                            </label>
                            <label class="btn btn-size">
                                <input type="radio" name="size" value="l" autocomplete="off"> L
                            </label>
                            <label class="btn btn-size">
                                <input type="radio" name="size" value="xl" autocomplete="off"> XL
                            </label>
                        </div>
                    </div>{{--/form-group--}}

                    <div class="form-row mb-3">
                        <div class="col-md-3 my-1">
                            <div class="number-input  mb-0">
                                <button type="button"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                        class="minus py-2 font-weight-bold">-
                                </button>
                                <input class="quantity" min="0" max="10" name="quantity" value="1" type="number">
                                <button type="button"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                        class="plus py-2 font-weight-bold">+
                                </button>
                            </div>
                        </div>
                        <div class="col-auto my-1">
                            <button class="btn btn-add-cart btn-primary flex-shrink-0" name="add-to-cart" type="submit">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Adicionar ao carrinho
                            </button>
                        </div>
                    </div>{{--/form-row--}}
                </div>{{--/col-md-6--}}
            </div>
        </section>
    </div>
@endsection
