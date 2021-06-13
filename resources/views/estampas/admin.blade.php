@extends('layout_admin')
@section('title','Estampas')
@section('content')

    <div class="row mb-3">
        <div class="col-2">
            <a href="{{route('admin.estampas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova
                Estampa</a>
        </div>
    </div>
    <div class="card">
        <header class="card-header">

        <form method="GET" action="#" >

        <div class="row align-items-end">
            <div class="col-md-6 col-lg-2 form-group">
                <label for="inputState">Categoria</label>
                <div class="input-group">
                    <select class="custom-select" name="categoria" id="idCat">
                        <option value="show_all" {{$categoriaSel == 'show_all' ? 'selected' : ''}}>Mostrar Tudo</option>
                        <option value="Sem Categoria" {{$categoriaSel == 'Sem Categoria' ? 'selected' : ''}}>Sem
                            categoria
                        </option>
                        @foreach ($listaCategorias as $id => $nome)
                            <option value="{{$id}}" {{$categoriaSel == $id ? 'selected' : ''}}>
                                {{$nome}}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-6 col-lg-2 form-group">
                <label for="inputState">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{$nomeSel}}">
            </div>
            <div class="col-md-6 col-lg-4 form-group">
                <label for="inputState">Descricao</label>
                <input type="text" class="form-control" name="descricao" value="{{$descricaoSel}}">
            </div>

            <div class="col-md-6 col-lg-3 form-group">
                <div class="btn-group ">
                    <a href="{{route('admin.estampas')}}" class="btn btn-secondary">Reset</a>
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                </div>
            </div>

        </div>


    </form>

        </header>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Descrição</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($estampas as $estampa)
            <tr>
                <td>
                    <img
                        src="{{$estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/plain_white.png') }}"
                        alt="Foto da estampa" class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{$estampa->nome}}</td>
                <td>{{$estampa->descricao}}</td>
                <td>
                    <a href="{{route('admin.estampas.edit', ['estampa' => $estampa])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="{{route('admin.estampas.destroy', ['estampa' => $estampa])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $estampas->withQueryString()->links() }}
    </div>
    </div>
@endsection

