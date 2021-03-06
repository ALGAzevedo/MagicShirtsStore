@extends('layout2')

@section('content')

    <div class="container">
        <!-- Product section-->
        <section class="mt-4">
            <div class="row">
                <div class="col-md-12">
                    @if (session('alert-msg'))
                        @include('partials.message')
                    @endif

                    @if ($errors->any())
                        @include('partials.errors')
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="shirt_base border p-4 ">
                        <img
                            class="shirt_base_thumbnail magic-shirt lazy"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                            data-src="{{asset('storage/tshirt_base/'.(old('cor_codigo') ?? $corSel->codigo). '.jpg')}}"
                            alt=""
                            data-storage="{{asset('storage/tshirt_base/')}}">
                        <div class="shirt_base-overlay">
                            <img class="shirt_base-overlay-img lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ static_asset($estampa->cliente_id,$estampa->imagem_url)}}"
                                 alt="{{$estampa->nome}}"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <h1 class="h2 font-weight-bold">{{$estampa->nome}}</h1>
                    <div class="fs-5 my-3">
                        @if($estampa->client_id)
                            <h4>{{ number_format($preco->preco_un_proprio, 2, ',', '.')}}&euro;</h4>
                        @else
                            <h4>{{ number_format($preco->preco_un_catalogo, 2, ',', '.')}}&euro;</h4>
                        @endif
                    </div>
                    <p class="lea w-75">{{$estampa->descricao}}</p>
                    {{--form--}}
                    <form action="{{route('carrinho.add', ['estampa' => $estampa])}}" method="POST">
                        @csrf
                        <input type="hidden" name="estampa_id" value="{{$estampa->id}}">
                        <div class="form-row mb-3">
                            <div class="col-md-5 my-1">
                                <label for="idCor">Escolha a cor: </label>
                                <select class="form-control magic-color" name="cor_codigo" id="idCor">
                                    @foreach ($listaCores as $cor)
                                        <option
                                            value="{{$cor->codigo}}" {{  old('cor_codigo') == $cor->codigo ? 'selected' : ''}}>
                                            {{$cor->nome}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>{{--/form-row--}}
                        <div class="form-group mb-3">
                            <label>Tamanho</label>
                            <div class="btn-groupx btn-group-toggle" data-toggle="buttons">
                                @foreach ($tamanhos as $tamanho)
                                <label class="btn btn-size">
                                    <input type="radio" name="tamanho" value="{{$tamanho}}" {{old('tamanho') == $tamanho ? 'checked' : ''}} autocomplete="off"> {{$tamanho}}
                                </label>
                                @endforeach
                            </div>
                        </div>{{--/form-group--}}

                        <div class="form-row mb-3">
                            <div class="col-md-3 my-1 ">
                                <label class="mr-2">Quantidade</label>
                                <div class="number-input  mb-0">
                                    <button type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                            class="minus py-2 font-weight-bold">-
                                    </button>
                                    <input class="quantity" min="1" max="100" name="quantidade" value="1" type="number">
                                    <button type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                            class="plus py-2 font-weight-bold">+
                                    </button>
                                </div>
                            </div>
                        </div>{{--/form-row--}}
                        <div class="form-row mb-3">
                            <div class="col-auto my-1">
                                <button class="btn btn-add-cart btn-primary flex-shrink-0" name="add-to-cart"
                                        type="submit">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Adicionar ao carrinho
                                </button>
                            </div>
                        </div>{{--/form-row--}}
                    </form>{{--/form--}}
                </div>{{--/col-md-6--}}

            </div>
        </section>
    </div>

@endsection
