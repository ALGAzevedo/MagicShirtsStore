<?php


use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstampaController;

use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PageController;
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

//ADMINISTRAÇÃO

//MAIN
Route::get('administracao', [DashboardController::class, 'index'])->name('administracao');


//ADMINISTRACAO FUNCIONARIOS
Route::get('administracao/funcionarios', [UserController::class, 'admin_funcs'])->name('admin.funcionarios');
Route::get('administracao/funcionarios/{funcionario}/edit', [UserController::class, 'edit'])->name('admin.funcionarios.edit');
Route::get('administracao/funcionarios/create', [UserController::class, 'create'])->name('admin.funcionarios.create');
Route::post('administracao/funcionarios', [UserController::class, 'store'])->name('admin.funcionarios.store');
Route::put('administracao/funcionarios/{funcionario}', [UserController::class, 'update'])->name('admin.funcionarios.update');
Route::delete('administracao/funcionarios/{funcionario}', [UserController::class, 'destroy'])->name('admin.funcionarios.destroy');
Route::delete('administracao/funcionarios/{funcionario}/foto', [UserController::class, 'destroy_foto'])->name('admin.funcionarios.foto.destroy');

//ADMINISTRACAO PARA CLIENTES

Route::get('administracao/clientes', [ClienteController::class, 'show_clientes'])->name('admin.clientes');
Route::get('administracao/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit');
Route::get('administracao/clientes/create', [ClienteController::class, 'create'])->name('admin.clientes.create');
Route::post('administracao/clientes', [ClienteController::class, 'store'])->name('admin.clientes.store');
Route::put('administracao/clientes/{cliente}', [ClienteController::class, 'update'])->name('admin.clientes.update');
Route::delete('administracao/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy');
Route::delete('administracao/clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('admin.clientes.foto.destroy');


Auth::routes(['register' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
