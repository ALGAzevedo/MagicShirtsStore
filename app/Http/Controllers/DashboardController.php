<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index(){

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
            'chart_title' => 'Tipos de pagamento utilizados nos últimos 30 dias',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cliente',
            'group_by_field' => 'tipo_pagamento',
            'aggregate_function' => 'count',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart4 = Cache::remember('_chart4', now()->addMinutes(5), function() use ($chart_options) {
            return new LaravelChart($chart_options);
        });



        return view('administracao.index',compact('chart1', 'chart2', 'chart3', 'chart4'));
    }
}
