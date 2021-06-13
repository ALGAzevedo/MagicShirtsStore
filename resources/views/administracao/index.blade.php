@extends('layout_admin')
@can('viewCharts')
@section('content')
    <div class="no-gutters row">
        <div class="cl col-lg-3">
            <div class="card br-0 card-body mb-2 mb-md-0">
                <div class="card-resume">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary fas fa-euro-sign"></i></span>
                    <div class="text">

                        <span>13,456 €</span>
                        <h6 class="mb-0 card-title">vendas</h6>
                        <span class="text-sm">líquidas este mês </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl col-lg-3">
            <div class="card br-0 card-body  mb-2 mb-md-0">
                <div class="card-resume">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success fas fa-box-open"></i></span>
                    <div class="text">
                        <span>3</span>
                        <h6 class="mb-0 card-title">encomendas</h6>
                        <span class="text-sm">
                                    a aguardar processamento
                                </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl col-lg-3">
            <div class="card br-0 card-body  mb-2 mb-md-0">
                <div class="card-resume">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning fas fa-shopping-basket"></i></span>
                    <div class="text">
                        <span>9.856€</span>
                        <h6 class="mb-0 card-title">Itens vendidos</h6>
                        <span class="text-sm">
                                    Total de vendas hoje
                                </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl col-lg-3">
            <div class="card br-0 card-body  mb-2 mb-md-0">
                <article class="card-resume">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info fas fa-user-alt"></i></span>
                    <div class="text">
                        <span>0</span>
                        <h6 class="mb-0 card-title">registo</h6>
                        <span class="text-sm">
                                    de novos clientes
                                </span>
                    </div>
                </article>
            </div>
        </div>
    </div>


                <div class="card mt-4">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 p-3">
                                <h3>{{ $chart1->options['chart_title'] }}</h3>
                                {!! $chart1->renderHtml() !!}
                            </div>
                            <div class="col-md-6 p-3">
                                <h3>{{ $chart2->options['chart_title'] }}</h3>
                                {!! $chart2->renderHtml() !!}
                            </div>
                            <div class="col-md-6 p-3">
                                <h3>{{ $chart3->options['chart_title'] }}</h3>
                                {!! $chart3->renderHtml() !!}
                            </div>
                            <div class="col-md-6 p-3">
                                <h3>{{ $chart4->options['chart_title'] }}</h3>
                                {!! $chart4->renderHtml() !!}
                            </div>
                        </div>

                    </div>

    </div>
@endsection

@section('javascript')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
@endsection
@endcan
