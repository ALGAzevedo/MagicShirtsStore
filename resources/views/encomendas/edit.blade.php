@extends('layout_admin')
@section('title','Alterar Estado Encomenda')
@section('content')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                @foreach ($shirts as $shirt)
                <div class="row mb-3">
                    <div class="col-6">
                        <table class="table">
                            <tbody>

                                <tr>
                                    <th>Estampa Id</th>
                                    <td>{{$shirt->estampa->id}}</td>
                                </tr>
                                <tr>
                                    <th>Cor Codigo</th>
                                    <td>{{$shirt->cor_codigo}}</td>
                                </tr>
                                <tr>
                                    <th>Tamanho</th>
                                    <td>{{$shirt->tamanho}}</td>
                                </tr>
                                <tr>
                                    <th>Quantidade</th>
                                    <td>{{$shirt->quantidade}}</td>
                                </tr>
                                <td>

                                </td>

                            </tbody>
                        </table>

                    </div>
                    <div class="col-6">
                        <div class="layered-image">
                            <img class="image-base img-thumbnail" src="{{asset('storage/tshirt_base/' . $shirt->cor_codigo . '.jpg')}}"
                                 alt="tshirt base"/>
                            <img class="image-overlay" src="{{asset('storage/estampas/' . $shirt->Estampa->imagem_url)}}" alt=""/>
                        </div>
                    </div>
                </div>

                @endforeach





                <div class="encomenda-info">
                    <div class="encomenda-notas">
                        <span class="encomenda-label">Notas</span>
                        <span class="encomenda-info-desc">{{$encomenda->notas}}</span>
                    </div>
                    <div class="encomenda-endereco">
                        <span class="encomenda-label">Endereco</span>
                        <span class="encomenda-info-desc">{{$encomenda->endereco}}</span>
                    </div>
                </div>

                <form method="POST" action="{{route('admin.encomendas.update', ['encomenda' => $encomenda])}}">
                    @csrf
                    @method('PUT')
                <div class="form-group text-right">
                    @isset($estadoSeguinte)
                        <?php $botao = $estadoSeguinte == "paga" ? "Declarar como Paga" : "Declarar como Fechada" ?>

                        <button type="submit" class="btn btn-success" name="estado" value="{{$estadoSeguinte}}">{{$botao}}</button>
                    @endisset
                    @if($encomenda->estado != "anulada")
                        <button type="submit" class="btn btn-danger" name="estado" value="anulada">Anular Encomenda</button>
                    @endif
                    <a href="{{route('admin.encomendas.edit', ['encomenda' => $encomenda])}}" class="btn btn-secondary">Cancel</a>
                </div>

                </form>
        </div>
    </div>
@endsection
