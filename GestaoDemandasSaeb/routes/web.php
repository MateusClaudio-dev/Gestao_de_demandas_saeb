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

// Route::get('evento.index', [EventoController::class, 'index'])->nome('inicio');
