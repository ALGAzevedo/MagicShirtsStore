@extends('layout2')

@section('content')

    <div class="container">
        <div class="d-flex flex-row">
            <h2>Escolha a sua Tshirt</h2>
        </div>
        <div class="d-flex flex-row bd-highlight">

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
                    <br>
                    <div class="search-item">
                        <button type="submit" class="btn btn-secondary">Filtrar</button>
                    </div>
                </form>

                <form class="cor-search">
                    <div class="form-tamanho">
                        <label for="exampleFormControlSelect1">Escolha o tamanho: </label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                </form>
                <form class="pagamento-search">
                    <div class="form-pagamento">
                        <label for="exampleFormControlSelect1">Tipo Pagamento: </label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option value="MC">MC</option>
                            <option value="Paypal">PayPal</option>
                            <option value="Visa">Visa</option>

                        </select>
                    </div>
                </form>
                <label for="quantidade">Quantidade: </label>
                <input class="form-control" type="text" placeholder="Insira quantidade"
                       aria-label="default input example">
            </div>
            <div class="layered-image p-2 bd-highlight">
                <img class="image-base img-thumbnail" src="{{asset('storage/tshirt_base/' . $corSel->codigo . '.jpg')}}"
                     alt="tshirt base"/>
                <img class="image-overlay" src="{{asset('storage/estampas/' . $estampa->imagem_url)}}" alt=""/>
            </div>

        </div>
    </div>
    </div>
@endsection
