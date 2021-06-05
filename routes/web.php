<?php


use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PrecosController;
use App\Http\Controllers\EncomendaController;

use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\CartController;

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

Route::get('about', [PageController::class, 'about'])->name('about');

Route::get('tshirts/{estampa}', [TshirtController::class, 'choose'])->name('tshirts.choose');


//ROTAS DO CARRINHO
//Route::get('tshirts/{estampa}/{codigo}', [TshirtController::class, 'choose'])->name('tshirts.chooseWithColor');
Route::get('carrinho', [CartController::class, 'index'])->name('carrinho');
Route::post('carrinho/add_item', [CartController::class, 'add'])->name('carrinho.add');
Route::get('carrinho/{uuid}', [CartController::class, 'update_item'])->name('carrinho.update_item');
Route::put('carrinho/{uuid}', [CartController::class, 'update'])->name('carrinho.update');
Route::delete('carrinho/{uuid}', [CartController::class, 'destroy_item'])->name('carrinho.destroy_item');
Route::post('carrinho', [CartController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho', [CartController::class, 'destroy'])->name('carrinho.destroy');


//ADMINISTRAÇÃO

//MAIN

Route::middleware('auth')->prefix('administracao')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')
        ->middleware('can:access-administration');


//ADMINISTRACAO ESTAMPAS
    Route::get('estampas', [EstampaController::class, 'admin_index'])->name('estampas');
    Route::get('estampas/{estampa}/edit', [EstampaController::class, 'edit'])->name('estampas.edit');
    Route::put('estampas/{estampa}', [EstampaController::class, 'update'])->name('estampas.update');
    Route::delete('estampas/{estampa}', [EstampaController::class, 'destroy'])->name('estampas.destroy');
    Route::get('estampas/create', [EstampaController::class, 'create'])->name('estampas.create');
    Route::post('estampas', [EstampaController::class, 'store'])->name('estampas.store');

//ADMINISTRACAO CATEGORIAS
    Route::get('categorias', [CategoriaController::class, 'admin_index'])->name('categorias');
    Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

//ADMINISTRACAO PRECOS
    Route::get('precos', [PrecosController::class, 'admin_index'])->name('precos');
    Route::get('precos/{precos}/edit', [PrecosController::class, 'edit'])->name('precos.edit');
    Route::put('precos/{precos}', [PrecosController::class, 'update'])->name('precos.update');

//ADMINISTRACAO ENCOMENDAS

    Route::get('encomendas', [EncomendaController::class, 'admin_index'])->name('encomendas');
    Route::get('encomendas/{encomenda}/edit', [EncomendaController::class, 'admin_edit'])->name('encomendas.edit')
        ->middleware('can:view,encomenda');
    Route::put('encomendas/{encomenda}', [EncomendaController::class, 'admin_update'])->name('encomendas.update')
        ->middleware('can:update,encomenda');


//ADMINISTRACAO FUNCIONARIOS
    Route::get('funcionarios', [UserController::class, 'admin_funcs'])->name('funcionarios')
        ->middleware('can:viewAny, App\Models\User');
    Route::get('funcionarios/{funcionario}/edit', [UserController::class, 'edit'])->name('funcionarios.edit')
        ->middleware('can:view,funcionario');
    Route::get('funcionarios/create', [UserController::class, 'create'])->name('funcionarios.create')
        ->middleware('can:create, App\Models\User');
    Route::post('funcionarios', [UserController::class, 'store'])->name('funcionarios.store')
        ->middleware('can:create, App\Models\User');
    Route::put('funcionarios/{funcionario}', [UserController::class, 'update'])->name('funcionarios.update')
        ->middleware('can:update,funcionario');
    Route::get('funcionarios/{funcionario}/password', [UserController::class, 'viewPassword'])->name('funcionarios.password.update')
        ->middleware('can:updatePassword,funcionario');
    Route::put('funcionarios/password/{funcionario}', [UserController::class, 'updatePassword'])->name('funcionarios.updatePassword')
        ->middleware('can:updatePassword,funcionario');
    Route::delete('funcionarios/{funcionario}', [UserController::class, 'destroy'])->name('funcionarios.destroy')
        ->middleware('can:delete,funcionario');
    Route::delete('funcionarios/{funcionario}/foto', [UserController::class, 'destroy_foto'])->name('funcionarios.foto.destroy')
        ->middleware('can:update, funcionario');

//ADMINISTRACAO PARA CLIENTES

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes')
        ->middleware('can:viewAny,App\Models\Cliente');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'show'])->name('clientes.edit')
        ->middleware('can:view,cliente');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create')
        ->middleware('can:create,App\Models\Cliente');
//Route::post('clientes', [ClienteController::class, 'store'])->name('admin.clientes.store');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')
        ->middleware('can:delete,cliente');
    Route::delete('clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('clientes.foto.destroy')
        ->middleware('can:update,cliente');
    Route::put('clientes/{cliente}/block', [ClienteController::class, 'block'])->name('clientes.block')
        ->middleware('can:updateBlock,cliente');
});

//EDICAO PERFIL DO CLIENTE

Route::get('cliente/{cliente}/edit', [ClienteController::class, 'show'])->name('clientes.edit')
    ->middleware('can:view,cliente');
Route::get('cliente/{cliente}/password', [ClienteController::class, 'viewPassword'])->name('clientes.password.update')
    ->middleware('can:update,cliente');
Route::put('cliente/password/{cliente}', [ClienteController::class, 'updatePassword'])->name('clientes.updatePassword')
    ->middleware('can:updatePassword,cliente');

Auth::routes(['register' => true]);


