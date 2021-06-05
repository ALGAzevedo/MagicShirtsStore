<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index(){

        $chart_options = [
            'chart_title' => 'Transações por dia',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Encomenda',
            'group_by_field' => 'data',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
            'date_format_filter_days',
            'group_by_field_format' => 'Y-m-d'
        ];

        $chart1 = new LaravelChart($chart_options);

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

        $chart2 = new LaravelChart($chart_options);


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

        $chart3 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tipos de pagamento utilizados nos últimos 30 dias',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cliente',
            'group_by_field' => 'tipo_pagamento',
            'aggregate_function' => 'count',
            'chart_type' => 'bar',
        ];

        $chart4 = new LaravelChart($chart_options);



        return view('administracao.index',compact('chart1', 'chart2', 'chart3', 'chart4'));
    }
}
