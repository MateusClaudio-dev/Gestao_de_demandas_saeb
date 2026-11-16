<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

/*
|--------------------------------------------------------------------------
| Metódos Controladores 
|--------------------------------------------------------------------------
| get       | index()   | Lista registros 
| get       | create()  | Mostra formulário
| post      | store()   | Salva no banco
| get       | show()    | Mostra registro
| get       | edit()    | Carrega formulário p/ edição
| put       | update()  | Atualiza os dados
| delete    | destroy() | Remove os registros

*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index-evento', [EventoController::class, 'index'])->name('evento.index');
Route::get('/create-evento', [EventoController::class, 'create'])->name('evento.create');
Route::post('/store-evento', [EventoController::class, 'store'])->name('evento.store');
Route::get('/show-evento', [EventoController::class, 'show'])->name('evento.show');
Route::get('/edit-evento/{eventoSelecionado}', [EventoController::class, 'edit'])->name('evento.edit');
Route::put('/update-evento/{eventoSelecionado}', [EventoController::class, 'update'])->name('evento.update');
Route::delete('/destroy-evento/{eventoSelecionado}', [EventoController::class, 'destroy'])->name('evento.destroy');
