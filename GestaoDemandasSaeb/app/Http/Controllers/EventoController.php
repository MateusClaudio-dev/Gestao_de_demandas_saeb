<?php

namespace App\Http\Controllers;
use App\Http\Requests\EventoRequest;
use Illuminate\Http\Request;
use App\Models\Evento;

# | get       | index()   | Lista registros 
# | get       | create()  | Mostra formulário
# | post      | store()   | Salva no banco
# | get       | show()    | Mostra registro
# | get       | edit()    | Carrega formulário p/ edição
# | put       | update()  | Atualiza os dados
# | delete    | destroy() | Remove os registros

class EventoController extends Controller
{
    // Listar eventos salvos no banco de dados.
    public function index()
    {
        // Recupera os registros do BD
        $eventos = Evento::orderByDesc('created_at')->get();
        
        # Apresenta o calendário (FullCalendar)
        return view('index', ['eventos' => $eventos]);
    }

    // public function create(EventoRequest $request)
    // {
       
    public function store(EventoRequest $request)
    {
         $request->validated();

        try {
            $evento = Evento::create([
                'titulo' => $request->titulo,
                'inicio' => $request->inicio,
                'termino' => $request->termino,
            ]);

            // Salvar log
            Log::info('Evento salvo', ['id' => $evento->id, 'titulo' => $evento->titulo]);

        } catch (PDOexception $error) {

            Log::error('Erro ao tentar salvar evento',['error' => $error->getMessage()]);

            return back()->withInput()->with('error', 'Não foi possível salvar o agendamento. Tente novamente mais tarde');
        }
        
        
    }
    
    public function show()
    {

    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function destroy(Evento $eventoSelecionado) 
    {
        $eventoSelecionado->delete();
    }

}
