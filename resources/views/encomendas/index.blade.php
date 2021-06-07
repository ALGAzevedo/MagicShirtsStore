@extends('layout2')
@section('content')
    <div class="container">
        @include('myaccount.partials.title')
        <div class="row">

            @include('myaccount.partials.sidebar')

            <div class="col-md-9">
                @if (session('alert-msg'))
                    @include('partials.message')
                @endif
                @if ($errors->any())
                    @include('partials.errors')
                @endif
                <div class="card">

                    <header class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <b class="d-inline-block mr-3">Encomendas</b>
                    </header>
                    <div class="card-body">

                        <form method="GET" action="{{route('cliente.encomendas')}}" >
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-4 ">
                                    <label for="inputEstado">Estado</label>
                                    <select class="form-control" name="estado" id="idEstado">
                                        <option value="" {{$estadoSel == "" ? 'selected' : ''}}>Mostrar Tudo</option>
                                        <option value="anulada" {{$estadoSel == "anulada" ? 'selected' : ''}}>Anulada
                                        </option>
                                        <option value="fechada" {{$estadoSel == "fechada" ? 'selected' : ''}}>Fechada
                                        </option>
                                        <option value="paga" {{$estadoSel == "paga" ? 'selected' : ''}}>Paga</option>
                                        <option value="pendente" {{$estadoSel == "pendente" ? 'selected' : ''}}>
                                            Pendente
                                        </option>

                                    </select>
                                </div>
                                <div class="form-group col-md-4 ">
                                    <label for="inputState">Data</label>
                                    <input type="date" class="form-control" name="data" value="{{$dataSel}}">
                                </div>
                            <div class="form-group col-md-4">
                                <div class="btn-group btn-toolbar">
                                    <a href="{{route('cliente.encomendas')}}" class="btn btn-secondary">Reset</a>
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>

                            </div>
                            </div>
                        </form>

                        @if($encomendas->count() <= 0)
                            <div class="mt-4 text-center d-block">
                                <span>Não existem encomendas </span>
                            </div>

                        @else

                            <div class=" table-responsive mt-3">
                    <table class="table table-hover table-encomendas">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Data</th>
                            <th>Estado</th>
                            <th>FATURA-RECIBO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($encomendas as $encomenda)
                            <tr>
                                <td>
                                    <a href="{{route('cliente.encomenda.view', ['encomenda' => $encomenda])}}">{{$encomenda->id}}</a>
                                </td>
                                <td>{{$encomenda->data}}</td>
                                <td> <span class="encomenda-status text-{{$encomenda->estado}}"> {{$encomenda->estado}}</span></td>
                                <td width="250"> @if($encomenda->recibo_url != null && $encomenda->estado == "fechada" )
                                        <a href="{{$encomenda->recibo_url}}" class="btn btn-outline-primary btn-xs"><i class="fas fa-file-alt mr-2"></i> Fatura recibo</a>
                                    @endif  <a href="{{route('cliente.encomenda.view', ['encomenda' => $encomenda])}}" class="btn btn-light btn-xs">Detalhe </a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                            </div>
                        @endif

                    </div>
                </div>

            </div> <!-- col.// -->

        </div>

    </div>
@endsection
