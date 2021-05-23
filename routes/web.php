<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstampaController;

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

Route::get('administracao/funcionarios', [UserController::class, 'admin_funcs'])->name('admin.funcionarios');

//Route::get('tshirts/{estampa}/{codigo}', [TshirtController::class, 'choose'])->name('tshirts.chooseWithColor');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
