<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\EstampaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('estampas', [EstampaController::class, 'index'])->name('estampas.index');



Route::get('admin/disciplinas', [DisciplinaController::class, 'admin_index'])->name('admin.disciplinas');

Route::get('disciplinas', [DisciplinaController::class, 'index'])->name('disciplinas.index');


Route::get('docentes',  [DocenteController::class, 'index'])->name('docentes.index');

Route::get('candidaturas', [CandidaturaController::class, 'create'])->name('candidaturas.index');

Route::post('candidaturas', [CandidaturaController::class, 'store'])->name('candidaturas.store');
