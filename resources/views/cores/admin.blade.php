@extends('layout_admin')
@section('title','Cores')
@section('content')
    <div class="row mb-3">
        <div class="col-2">
            <a href="{{route('admin.cores.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova
                Cor</a>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Codigo</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cores as $cor)
            <tr>

                <td>{{$cor->nome}}</td>
                <td>{{$cor->codigo}}</td>
                <td>
                    <form action="{{route('admin.cores.destroy', ['cor' => $cor])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $cores->withQueryString()->links() }}




@endsection
