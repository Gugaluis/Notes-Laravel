<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index ()
    {
        // Carrega notas do usuário
        $id = session ('user.id');
        $user = User::find ($id) -> toArray ();
        $notes = User::find ($id) ->notes () -> whereNull('deleted_at') -> get () -> toArray();

        // Mostra a vier home
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        // Mostra a view new note
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        // Valida a requisição
    
        $request->validate(
        // Regras
        [
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ],

        // Mensagens de erro
        [
            'text_title.required' => 'O titulo é obrigatório',
            'text_title.min' => 'O titulo deve ter pelo menos :min caracteres',
            'text_title.max' => 'O titulo deve ter no máximo :max caracteres',
            
            'text_note.required' => 'A nota é obrigatória',
            'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
            'text_note.max' => 'A nota deve ter no máximo :max caracteres'
        ]
        );

        // Retorna ID do usuário
        $id = session('user.id');

        // Cria uma nova nota
        $note = new Note();
        $note-> user_id = $id;
        $note-> title = $request->text_title;
        $note-> text = $request->text_note;
        $note-> save();

        // Redireciona para a página inicial
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);

        if ($id === null){
            return redirect()->route('home');
        }

        // Carrega a nota a ser editada
        $note = Note::find($id);

        // Mostra a view da nota a ser editada
        return view('edit_note', ['note' => $note ]);
    }

    public function editNoteSubmit(Request $request)
    {
        // Validação do request
        $request-> validate(
            // Regras
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
    
            // Mensagens de erro
            [
                'text_title.required' => 'O titulo é obrigatório',
                'text_title.min' => 'O titulo deve ter pelo menos :min caracteres',
                'text_title.max' => 'O titulo deve ter no máximo :max caracteres',
                
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
            );

        // Checa se o ID da nota existe
        if($request->note_id == null)
        {
            return redirect()->route('home');
        }

        // Desencripta o ID da nota
        $id = Operations::decryptId($request->note_id);

        if ($id === null){
            return redirect()->route('home');
        }
        
        // Carrega a nota
        $note = Note::find($id);

        // Atualiza a nota
        $note-> title = $request->text_title;
        $note-> text = $request->text_note;
        $note-> save();

        // Redireciona para a tela inicial
        return redirect()->route('home'); 
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        
        if ($id === null){
            return redirect()->route('home');
        }

        // Carrega a nota
        $note = Note::find($id);

        // Mostra a view de confirmação da nota
        return view('delete_note', ['note' => $note]);
    }
    
    public function deleteNoteConfirm($id)
    {
        // Checa se o ID está encriptado
        $id = Operations::decryptId($id);

        if ($id === null){
            return redirect()->route('home');
        }

        // Carrega a nota
        $note = Note::find($id);

        // 1. Soft delete (Com propriedade no model)
        $note->delete();

        // Redireciona para a tela inicial
        return redirect()->route('home'); 

    }

}