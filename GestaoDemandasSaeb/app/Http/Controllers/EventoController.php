<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        # Apresenta o calendário (FullCalendar)
        return view('index');
    }
}
