@extends('layout2')

@section('content')

    <div class="container">

            <!-- Product section-->
            <section class="py-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
            
                    <div class="col-md-6">
                            <div class="layered-image p-2 bd-highlight">
                                <img class="image-base img-thumbnail" src="{{asset('storage/tshirt_base/' . $corSel->codigo . '.jpg')}}"
                                    alt="tshirt base"/>
                                <img class="image-overlay" src="{{asset('storage/estampas/' . $estampa->imagem_url)}}" alt=""/>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 font-weight-bold">{Nome}</h1>
                        <div class="fs-5 mb-3">
                            <h4>{preço}</h4>
                        </div>
                        <p class="lea">{Descrição}</p>
                        <form action="{{ url('/') }}" method="GET">
                        @csrf
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
        </section>
    
    </div>
    </div>
@endsection
