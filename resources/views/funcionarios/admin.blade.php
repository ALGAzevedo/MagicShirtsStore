@extends('layout_admin')
@section('title','Funcionários' )
@section('content')

    <div class="row mb-3">
        <div class="col-3">
            <a href="{{route('admin.funcionarios.create')}}" class="btn btn-success" role="button" aria-pressed="true">Novo
                Funcionario</a>
        </div>
    </div>


    <div class="card">
        <header class="card-header">

                <form method="GET" action="{{route('admin.funcionarios')}}" >
                    <div class="form-row">
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group">
                            <label for="inputBloqueado">Bloqueado</label>
                            <div class="input-group">
                                <select class="custom-select" name="bloqueado" id="bloqueado">
                                    <option value="">Todos</option>
                                    <option value="1">Bloqueados</option>
                                    <option value="0">Não Bloqueados</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-2 col-md-6">
                            <div class="form-group">
                            <label for="inputTipo">Tipo</label>
                            <div class="input-group">
                                <select class="custom-select" name="tipo" id="tipo">
                                    <option value="">Todos</option>
                                    <option value="A">Administradores</option>
                                    <option value="F">Funcionários</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6 col-lg-3">
                    <div class="form-group">

                            <label for="inputNome">Nome</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="inputNome" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="inputEmail" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Filtrar</button>
                                </div>
                            </div>

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
            <th>Email</th>
            <th>Tipo</th>
            <th>Bloqueado</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($funcs as $func)
            <tr {{$func->admin ? 'class=table-success' : ''}}>
                <td>
                    <img
                        src="{{$func->foto_url ? asset('storage/fotos/' . $func->foto_url) : asset('img/default_img.png') }}"
                        alt="Foto do utilizador" class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{$func->name}}</td>
                <td>{{$func->email}}</td>
                @if($func->tipo == 'F')
                    <td>Funcionário</td>
                @elseif($func->tipo == 'A')
                    <td>Administrador</td>
                @else
                    <td>ERRO</td>
                @endif

                @if($func->bloqueado == 1)
                    <td>Sim</td>
                @else
                    <td>Não</td>
                @endif

                <td><a href="{{route('admin.funcionarios.edit', ['funcionario' => $func])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true"> <i class="fas fa-pen mr-2"></i> Alterar</a></td>
                <td>
                    <form action="{{route('admin.funcionarios.destroy', ['funcionario' =>$func])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash mr-2"></i>  Apagar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $funcs->withQueryString()->links() }}
            </div>
    </div>
    </div>
@endsection
