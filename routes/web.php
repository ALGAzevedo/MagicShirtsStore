<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UserController;
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

Route::get('administracao', [DashboardController::class, 'index'])->name('administracao');

Route::get('administracao/users', [UserController::class, 'admin_index'])->name('admin.users');

//ESTAMPAS
Route::get('administracao/estampas', [EstampaController::class, 'admin_index'])->name('admin.estampas');
Route::get('administracao/estampas/{estampa}/edit', [EstampaController::class, 'edit'])->name('admin.estampas.edit');
Route::put('administracao/estampas/{estampa}', [EstampaController::class, 'update'])->name('admin.estampas.update');
Route::delete('administracao/estampas/{estampa}', [EstampaController::class, 'destroy'])->name('admin.estampas.destroy');
Route::get('administracao/estampas/create', [EstampaController::class, 'create'])->name('admin.estampas.create');
Route::post('administracao/estampas', [EstampaController::class, 'store'])->name('admin.estampas.store');

//CATEGORIAS
Route::get('administracao/categorias', [CategoriaController::class, 'admin_index'])->name('admin.categorias');
Route::get('administracao/categorias/create', [CategoriaController::class, 'create'])->name('admin.categorias.create');
Route::post('administracao/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
Route::get('administracao/{categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
Route::put('administracao/{categoria}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
Route::delete('administracao/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

