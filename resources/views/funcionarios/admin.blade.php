@extends('layout_admin')
@section('title','Users' )
@section('content')

    <div class="row mb-3">
        <div class="col-3">
            <a href="{{route('admin.funcionarios.create')}}" class="btn btn-success" role="button" aria-pressed="true">Novo
                Funcionario</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Bloqueado</th>
            <th></th>
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
                @else
                    <td>Administrador</td>
                @endif

                @if($func->bloqueado == 1)
                    <td>Sim</td>
                @else
                    <td>Não</td>
                @endif

                <td><a href="{{route('admin.funcionarios.edit', ['funcionario' => $func])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a></td>
                <td>
                    <form action="{{route('admin.funcionarios.destroy', ['funcionario' =>$func])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $funcs->withQueryString()->links() }}
@endsection
