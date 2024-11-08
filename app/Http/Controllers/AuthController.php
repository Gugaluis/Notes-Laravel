<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correção aqui

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Validação do formulário 
        $request->validate(
            // Regras
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // Mensagens de erro
            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'A senha é obrigatória',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres'
            ]
        );

        // Capturar entrada do usuário
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Validando informações do usuário
        $user = User::where('username', $username)
            -> where ('deleted_at', NULL)
                ->first();

        if (!$user){
            return redirect()
                ->back()
                    ->withInput()
                        ->with('loginError', 'Usuario ou senha incorretos');
        }

        // Validando senha
        if (!password_verify($password, $user->password)){
            return redirect()
                ->back()
                    ->withInput()
                        ->with('loginError', 'Usuario ou senha incorretos');
        }

        // Atualizando o último login
        $user -> last_login = date('Y-m-d H:i:s');
        $user -> save;

        // Login do usuario
        session
        ([
            'user' => 
                [
                    'id' => $user->id,
                    'username' => $user->username
                ]
        ]);

        // Redirecionando para página inicial  
        return redirect()->to('/');
    }

    public function logout()
    {
        // Logout da aplicação
        session() -> forget('user');
        return redirect()->to('/login');
    }
}
