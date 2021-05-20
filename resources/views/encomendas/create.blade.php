@extends('layout2')

@section('content')

    <div class="container">
        <h2>Encomenda</h2>
        @csrf
        <div class="row">
            <div class="filter">
                <form class="cor-search">
                    <div class="search-item">
                        <label for="idCor">Escolha a cor: </label>
                        <select class="form-control" name="cor" id="idCor">
                            @foreach ($listaCores as $cor)
                                <option value="{{$cor->id}}" selected>
                                    {{$cor->nome}}
                                </option>
                            @endforeach
                        </select>
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
                <label for="quantidade">Quantidade: </label>
                <input class="form-control" type="text" placeholder="Insira quantidade"
                       aria-label="default input example">
            </div>


            <!-- Código antigo da candidatura -->


        </div>
    </div>
@endsection
