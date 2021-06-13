<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use mysql_xdevapi\Table;

class DashboardController extends Controller
{

    public function index(){

        //vendas este mes €
        $vendasMes = Encomenda::whereYear('data', Carbon::now()->year)
        ->whereMonth('data', Carbon::now()->month)
            ->sum('preco_total');

        //encomendas a aguardar processamento (em estado pago)
        $encomendasPagas = Encomenda::where('estado', 'paga')->count();

        //intens vendidos hoje
        $vendasHoje = Encomenda::where('data', Carbon::now()->format('Y-m-d'))->sum('preco_total');

        //registo clientes hoje
        $novosClientesHoje = Cliente::whereDate('created_at', Carbon::today())->count();

        //ESTAMPAS DISPONIVEIS NA LOJA
        $estampasDisponiveis = Estampa::where('cliente_id', null)->withoutTrashed()->count();

        //T-SHIRTS CUSTOMIZADAS VENDIDAS
        $shirtsClient = DB::Table('estampas')
            ->leftJoin('tshirts', 'estampas.id', '=', 'tshirts.estampa_id')
            ->Join('encomendas', 'tshirts.encomenda_id', '=','encomendas.id')
            ->whereNotNull('estampas.cliente_id')
            ->where('encomendas.estado', 'fechada')
            ->count();






        $chart_options = [
            'chart_title' => 'Transações por dia na última semana',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Encomenda',
            'group_by_field' => 'data',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
            'date_format_filter_days',
            'group_by_field_format' => 'Y-m-d',
            'filter_field' => 'created_at',
            'filter_period' => 'week',

        ];

        $chart1 = Cache::remember('_chart1', now()->addMinutes(5), function() use ($chart_options) {
            return new LaravelChart($chart_options);
        });

        $chart_options = [
            'chart_title' => 'Transações por mês',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Encomenda',
            'group_by_field' => 'data',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
            'date_format_filter_days',
            'group_by_field_format' => 'Y-m-d'
        ];

        $chart2 = Cache::remember('_chart2', now()->addMinutes(5), function() use ($chart_options) {
            return new LaravelChart($chart_options);
        });


        $chart_options = [
            'chart_title' => 'Registo de novos clientes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Cliente',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
            'date_format_filter_days',
            'group_by_field_format' => 'Y-m-d'
        ];

        $chart3 = Cache::remember('_chart3', now()->addMinutes(5), function() use ($chart_options) {
            return new LaravelChart($chart_options);
        });

        $chart_options = [
            'chart_title' => 'Tipos de pagamento utilizados no último mês',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Encomenda',
            'group_by_field' => 'tipo_pagamento',
            'aggregate_function' => 'count',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart4 = Cache::remember('_chart4', now()->addMinutes(5), function() use ($chart_options) {
            return new LaravelChart($chart_options);
        });



        return view('administracao.index',compact('chart1', 'chart2', 'chart3', 'chart4', 'vendasMes',
        'encomendasPagas', 'vendasHoje', 'novosClientesHoje', 'estampasDisponiveis', 'shirtsClient'));
    }
}
