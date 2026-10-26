<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    // Nome da tabela do Banco de Dados
    protected $table = 'events';

    // Indica quais colunas podem ser cadastradas
    protected $fillable = ['title', 'color', 'start', 'end'];
}
