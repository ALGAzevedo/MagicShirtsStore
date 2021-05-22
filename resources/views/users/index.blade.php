@extends('layout_admin')
@section('title','Users' )
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr {{$user->admin ? 'class=table-success' : ''}}>
                <td>
                    <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}" alt="Foto do utilizador"  class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->tipo}}</td>
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
