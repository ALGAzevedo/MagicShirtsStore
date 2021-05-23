@extends('layout_admin')
@section('title','Users' )
@section('content')


    <div class="row mb-3">
        <div class="col-3">
            <a href="{{route('admin.users.create')}}" class="btn btn-success" role="button" aria-pressed="true">Novo
                Funcionário</a>
        </div>
        <div class="col-9">
            <form method="GET" action="{{route('admin.disciplinas')}}" class="form-group">
                <div class="input-group">
                    <select class="custom-select" name="curso" id="inputCurso" aria-label="Curso">
                        <option value="" {{'' == old('curso', $selectedCurso) ? 'selected' : ''}}>Todos Cursos</option>
                        @foreach ($cursos as $abr => $nome)
                            <option
                                value={{$abr}} {{$abr == old('curso', $selectedCurso) ? 'selected' : ''}}>{{$nome}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </form>
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
        @foreach ($users as $user)
            <tr {{$user->admin ? 'class=table-success' : ''}}>
                <td>
                    <img
                        src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
                        alt="Foto do utilizador" class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                @if($user->tipo == 'F')
                    <td>Funcionário</td>
                @elseif($user->tipo == 'C')
                    <td>Cliente</td>
                @else
                    <td>Administrador</td>
                @endif

                @if($user->bloqueado == 1)
                    <td>Sim</td>
                @else
                    <td>Não</td>
                @endif
                
                <td><a href="#" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a></td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
@endsection
