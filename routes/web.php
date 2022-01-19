<?php

use App\Http\Controllers\ApostaController;
use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\NumerosController;
use App\Services\ApostaService;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Rotas dos concursos
Route::get('concurso/{id}', [ConcursoController::class, 'index'])->name('concursos');

Route::get('concurso/create/{id}', [ConcursoController::class, 'create'])->name('concurso.create');

Route::get('sortear/{concurso_id}', [NumerosController::class, 'create'])->name('sortear');

//Rotas das apostas
Route::get('/apostas/{concurso_id}', [ApostaController::class, 'index'])->name('aposta');

Route::get('/aposta/create/{concurso_id}', [ApostaController::class, 'create'])->name('aposta.create');

Route::get('/aposta/dados/{jogo_id}', [ApostaController::class, 'dados']);

Route::post('/aposta', [ApostaController::class, 'store'])->name('aposta.store');