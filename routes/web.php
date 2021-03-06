<?php


use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteEstampaController;
use App\Http\Controllers\CoresController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\PrecosController;
use App\Http\Controllers\EncomendaController;

use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('quem-somos', [PageController::class, 'about'])->name('about');

//ROTAS DO CARRINHO
Route::get('carrinho', [CartController::class, 'index'])->name('carrinho');
Route::post('carrinho/{estampa}', [CartController::class, 'add'])->name('carrinho.add');
Route::get('carrinho/{uuid}', [CartController::class, 'update_item'])->name('carrinho.update_item');
Route::put('carrinho/{uuid}', [CartController::class, 'update'])->name('carrinho.update');
Route::delete('carrinho/{uuid}/remove', [CartController::class, 'destroy_item'])->name('carrinho.destroy_item');
Route::post('carrinho', [CartController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho/empty', [CartController::class, 'destroy'])->name('carrinho.destroy');

//ADMINISTRAÇÃO

//MAIN

Route::middleware('auth')->prefix('administracao')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')
        ->middleware('can:access-administration');

//ADMINISTRACAO ESTAMPAS
    Route::get('estampas', [EstampaController::class, 'admin_index'])->name('estampas')
        ->middleware('can:viewAny_Admin,App\Models\Estampa');
    Route::get('estampas/{estampa}/edit', [EstampaController::class, 'edit'])->name('estampas.edit')
        ->middleware('can:view_Admin,estampa');
    Route::put('estampas/{estampa}', [EstampaController::class, 'update'])->name('estampas.update')
        ->middleware('can:update_Admin,estampa');
    Route::delete('estampas/{estampa}', [EstampaController::class, 'destroy'])->name('estampas.destroy')
        ->middleware('can:delete_Admin,estampa');
    Route::get('estampas/create', [EstampaController::class, 'create'])->name('estampas.create')
        ->middleware('can:create_Admin,App\Models\Estampa');
    Route::post('estampas', [EstampaController::class, 'store'])->name('estampas.store')
        ->middleware('can:create_Admin,App\Models\Estampa');

//ADMINISTRACAO CATEGORIAS
    Route::get('categorias', [CategoriaController::class, 'admin_index'])->name('categorias')
        ->middleware('can:viewAny,App\Models\Categoria');
    Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create')
        ->middleware('can:create,App\Models\Categoria');
    Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store')
        ->middleware('can:create,App\Models\Categoria');
    Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')
        ->middleware('can:view,categoria');
    Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')
        ->middleware('can:update,categoria');
    Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')
        ->middleware('can:delete,categoria');

//ADMINISTRACAO PRECOS
    Route::get('precos', [PrecosController::class, 'admin_index'])->name('precos')
        ->middleware('can:viewAny,App\Models\Preco');
    Route::get('precos/{precos}/edit', [PrecosController::class, 'edit'])->name('precos.edit')
        ->middleware('can:view,precos');
    Route::put('precos/{precos}', [PrecosController::class, 'update'])->name('precos.update')
        ->middleware('can:update,precos');

//ADMINISTRACAO ENCOMENDAS


    Route::get('encomendas', [EncomendaController::class, 'admin_index'])->name('encomendas')
        ->middleware('can:viewBackEncomenda, \App\Models\Encomenda');
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
        ->middleware('can:create,App\Models\User');
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
        ->middleware('can:update,funcionario');

//ADMINISTRACAO PARA CLIENTES

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes')
        ->middleware('can:viewAny,App\Models\Cliente');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create')
        ->middleware('can:create,App\Models\Cliente');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')
        ->middleware('can:delete,cliente');
    Route::delete('clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('clientes.foto.destroy')
        ->middleware('can:update,cliente');
    Route::put('clientes/{cliente}/block', [ClienteController::class, 'block'])->name('clientes.block')
        ->middleware('can:updateBlock,cliente');

//ADMINISTRACAO CORES
    Route::get('cores', [CoresController::class, 'index'])->name('cores')
        ->middleware('can:viewAny,App\Models\cor');
    Route::get('cores/create', [CoresController::class, 'create'])->name('cores.create')
        ->middleware('can:create,App\Models\cor');
    Route::post('cores', [CoresController::class, 'store'])->name('cores.store')
    ->middleware('can:create,App\Models\cor');
    Route::delete('cores/{cor}', [CoresController::class, 'destroy'])->name('cores.destroy')
        ->middleware('can:delete,cor');



});

//EDICAO PERFIL DO CLIENTE
Route::middleware(['auth', 'verifyBlocked'])->prefix('cliente')->name('cliente.')->group(function () {

    //PERFIL
    Route::get('{cliente}/edit', [ClienteController::class, 'show'])->name('edit')
        ->middleware('can:view,cliente');

    Route::get('{cliente}/password', [ClienteController::class, 'viewPassword'])->name('password.update')
        ->middleware('can:update,cliente');

    Route::put('password/{cliente}', [ClienteController::class, 'updatePassword'])->name('updatePassword')
        ->middleware('can:updatePassword,cliente');

    Route::put('{cliente}', [ClienteController::class, 'update'])->name('update')
        ->middleware('can:update,cliente');

    Route::delete('{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('foto.destroy')
        ->middleware('can:update,cliente');

//ESTAMPAS DO CLIENTE
    Route::get('/estampas', [ClienteEstampaController::class, 'index'])->name('estampas')
        ->middleware('can:viewPrivate,App\Models\Estampa');

    Route::get('/estampas/create', [ClienteEstampaController::class, 'create'])->name('estampas.create')
        ->middleware('can:create_private,App\Models\Estampa');
    Route::post('/estampas', [ClienteEstampaController::class, 'store'])->name('estampas.store')
        ->middleware('can:create_private,App\Models\Estampa');;
    Route::get('/estampas/{estampa}/edit', [ClienteEstampaController::class, 'edit'])->name('estampas.edit')
        ->middleware('can:update_private,estampa');
    Route::put('/estampas/{estampa}', [ClienteEstampaController::class, 'update'])->name('estampas.update')
        ->middleware('can:update_private,estampa');
    Route::delete('/estampas/{estampa}', [ClienteEstampaController::class, 'destroy'])->name('estampas.destroy')
        ->middleware('can:delete_private,estampa');

    //HISTORICO ENCOMENDA CLIENTES

    Route::get('encomendas', [EncomendaController::class, 'index'])->name('encomendas')
        ->middleware('auth');
    Route::get('encomendas/{encomenda}', [EncomendaController::class, 'view_encomenda'])->name('encomenda.view')
        ->middleware('can:viewClientEncomenda,encomenda');
});


// EXIBIÇÃO E DOWNLOAD DE FICHEIRO
Route::middleware('auth')->group(function () {
    Route::get('static/{path}', [ClienteEstampaController::class, 'serve_asset'])
        ->name('storage.asset');
});

//Tshirts
Route::get('estampas', [EstampaController::class, 'index'])->name('estampas.index');
Route::get('tshirts/{estampa}', [TshirtController::class, 'choose'])
    ->middleware('can:viewAnyPrivate,estampa')
    ->name('tshirts.choose');

//CHECKOUT
Route::middleware(['auth', 'emailVerified', 'can:checkout,App\Models\Encomenda'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'store'])->name('checkout.order');
});

Auth::routes(['register' => true]);


//EMAIL VERIFICATION

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')
        ->with('alert-msg', 'O seu email foi verificado!')
        ->with('alert-type', 'success');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//RECIBOS ENCOMENDA

//TODO: Remover da administracao
Route::get('encomendas/{encomenda}/fatura', [EncomendaController::class, 'openPdf'])->name('encomendas.viewPdf')
    ->middleware('can:viewFatura,encomenda');
Route::get('encomendas/{encomenda}/fatura/download', [EncomendaController::class, 'downloadPdf'])->name('encomendas.downloadPdf')
    ->middleware('can:viewFatura,encomenda');

