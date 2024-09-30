<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Home::class, 'breve'])->name('breve');
Route::get('/home', [Home::class, 'home'])->name('home');
Route::post('/email/mensagem', [Home::class, 'emailMensagem'])->name('emailMensagem');

//Apis
Route::post('/api/cadastro/galeria', [ApiController::class, 'CadastroGaleria'])->name('cadastro-galeria');