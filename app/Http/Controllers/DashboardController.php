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

    public function index(Request $request)
    {


        //vendas este mes €
        if (($vendasMes = Cache::get('vendasMes')) == null) {
            $vendasMes = Encomenda::whereYear('data', Carbon::now()->year)
                ->whereMonth('data', Carbon::now()->month)
                ->sum('preco_total');
            Cache::add('vendasMes', $vendasMes, now()->addMinutes(5));
        }

        //encomendas a aguardar processamento (em estado pago)
        if (($encomendasPagas = Cache::get('encomendasPagas')) == null) {
            $encomendasPagas = Encomenda::where('estado', 'paga')->count();
            Cache::add('encomendasPagas', $encomendasPagas, now()->addSeconds(30));
        }

        //intens vendidos hoje
        if (($vendasHoje = Cache::get('vendasHoje')) == null) {
            $vendasHoje = Encomenda::where('data', Carbon::now()->format('Y-m-d'))->sum('preco_total');
            Cache::add('vendasHoje', $vendasHoje, now()->addMinutes(5));
        }

        //registo clientes hoje
        if (($novosClientesHoje = Cache::get('novosClientesHoje')) == null) {
            $novosClientesHoje = Cliente::whereDate('created_at', Carbon::today())->count();
            Cache::add('novosClientesHoje', $novosClientesHoje, now()->addMinutes(5));
        }


        //ESTAMPAS DISPONIVEIS NA LOJA
        if (($estampasDisponiveis = Cache::get('estampasDisponiveis')) == null) {
            $estampasDisponiveis = Estampa::where('cliente_id', null)->withoutTrashed()->count();
            Cache::add('estampasDisponiveis', $estampasDisponiveis, now()->addMinutes(5));
        }


        //T-SHIRTS CUSTOMIZADAS VENDIDAS
        if (($shirtsClient = Cache::get('shirtsClient')) == null) {
            $shirtsClient = DB::Table('estampas')
                ->leftJoin('tshirts', 'estampas.id', '=', 'tshirts.estampa_id')
                ->Join('encomendas', 'tshirts.encomenda_id', '=', 'encomendas.id')
                ->whereNotNull('estampas.cliente_id')
                ->where('encomendas.estado', '=', 'fechada')
                ->count();
            Cache::add('shirtsClient', $shirtsClient, now()->addMinutes(5));
        }


        //ESTAMPAS MAIS VENDIDAS
        if (($estampasMais = Cache::get('estampasMais')) == null) {
            $estampasMais = Estampa::query()
                ->join('tshirts', 'tshirts.estampa_id', '=', 'estampas.id')
                ->join('encomendas', 'tshirts.encomenda_id', '=', 'encomendas.id')
                ->where('encomendas.estado', '=', 'fechada')
                ->selectRaw('estampas.*, SUM(tshirts.quantidade) AS quantidade_vend')
                ->groupBy(['estampas.id'])
                ->orderByDesc('quantidade_vend')
                ->take(5)->get();
            Cache::add('estampasMais', $estampasMais, now()->addMinutes(5));
        }


        //CORES MAIS VENDIDAS
        if(($coresMais = Cache::get('coresMais')) == null) {
            $coresMais = Tshirt::query()
                ->leftJoin('cores', 'tshirts.cor_codigo', '=', 'cores.codigo')
                ->select(DB::RAW('count(*) as quantidade_vend, cor_codigo, cores.nome'))
                ->groupBy('cor_codigo')
                ->orderByDesc('quantidade_vend')
                ->take(5)->get();
            Cache::add('coresMais', $coresMais, now()->addMinutes(5));
        }



        $chart_options = [
            'chart_title' => 'Transações diarias Semana',
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

        $chart1 = Cache::remember('_chart1', now()->addMinutes(5), function () use ($chart_options) {
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

        $chart2 = Cache::remember('_chart2', now()->addMinutes(5), function () use ($chart_options) {
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

        $chart3 = Cache::remember('_chart3', now()->addMinutes(5), function () use ($chart_options) {
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

        $chart4 = Cache::remember('_chart4', now()->addMinutes(5), function () use ($chart_options) {
            return new LaravelChart($chart_options);
        });


        return view('administracao.index', compact('chart1', 'chart2', 'chart3', 'chart4', 'vendasMes',
            'encomendasPagas', 'vendasHoje', 'novosClientesHoje', 'estampasDisponiveis', 'shirtsClient', 'estampasMais', 'coresMais'));
    }
}
