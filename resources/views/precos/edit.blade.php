@extends('layout_admin')
@section('title','Alterar Preços')
@section('content')
    <form method="POST" action="{{route('admin.precos.update', ['precos' => $precos]) }}" class="form-group">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputPreco_un_catalogo">Preco Unitário Catalogo</label>
            <input type="text" class="form-control" name="preco_un_catalogo" id="inputNome" value="{{old('preco_un_catalogo',$precos->preco_un_catalogo)}}" />
            @error('Preco_un_catalogo')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPreco_un_proprio">Preco Unitário Estampa Propria</label>
            <input type="text" class="form-control" name="preco_un_proprio" id="inputNome" value="{{old('preco_un_proprio', $precos->preco_un_proprio)}}" />
            @error('preco_un_proprio')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPreco_un_catalogo_desconto">Preco Unitário Catalogo com Desconto</label>
            <input type="text" class="form-control" name="preco_un_catalogo_desconto" id="inputNome" value="{{old('preco_un_catalogo_desconto',$precos->preco_un_catalogo_desconto)}}" />
            @error('preco_un_catalogo_desconto')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPreco_un_proprio_desconto">Preco Unitário Estampa Propria com Desconto</label>
            <input type="text" class="form-control" name="preco_un_proprio_desconto" id="inputNome" value="{{old('preco_un_proprio_desconto', $precos->preco_un_proprio_desconto)}}" />
            @error('preco_un_proprio_desconto')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputQuantidade_desconto">Quantidade Minima Para Desconto</label>
            <input type="text" class="form-control" name="quantidade_desconto" id="inputNome" value="{{old('quantidade_desconto', $precos->quantidade_desconto)}}" />
            @error('quantidade_desconto')
            <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>


        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.precos.edit', ['precos' =>$precos])}}" class="btn btn-primary">Reset</a>
            <a href="{{route('admin.precos')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
