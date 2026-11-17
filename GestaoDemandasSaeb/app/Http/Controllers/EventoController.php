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
       
    public function store(EventoRequest $request)
    {
        $dados = $request->validated();

        try {
            $evento = Evento::create($dados);

            return redirect()->route('evento.index')->with('success', 'Agendamento salvo com sucesso!');

        } catch (PDOException $error) {

            return back()->withInput()->with('error', 'Não foi possível salvar o agendamento. Tente novamente mais tarde');
        }
        
        
    }
    
    public function update(EventoRequest $request, Evento $eventoSelecionado)
    {
        $dados = $request->validated();

        try {
            $eventoSelecionado->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return redirect()->route('evento.index')->with('success', 'Agendamento atualizado com sucesso!');

        } catch (PDOException $error) {

            // Log::error('Erro ao tentar atualizar evento',['error' => $error->getMessage()]);

            return back()->withInput()->with('error', 'Não foi possível atualizar o agendamento. Tente novamente mais tarde');
        }
    }

    public function destroy(Evento $eventoSelecionado) 
    {
        $eventoSelecionado->delete();
    }

}
