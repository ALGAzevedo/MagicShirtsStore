@extends('layout')

@section('content')

    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Ano</th>
                <th>Sem.</th>
                <th>Abr.</th>
                <th>Nome</th>
                <th>ECTS</th>
                <th>Horas</th>
                <th>Opcional</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disc)
                <tr>
                    <td>{{$disc->curso}}</td>
                    <td>{{$disc->ano}}</td>
                    <td>{{$disc->semestre}}</td>
                    <td>{{$disc->abreviatura}}</td>
                    <td>{{$disc->nome}}</td>
                    <td>{{$disc->ECTS}}</td>
                    <td>{{$disc->horas}}</td>
                    <td>{{$disc->opcional ? 'Sim' : ''}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
