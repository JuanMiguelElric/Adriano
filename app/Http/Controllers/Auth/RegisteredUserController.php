<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados do formulário de registro
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Garantir que o email seja único
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Senha deve ser confirmada
            'role' => ['required', 'integer', 'in:0,1'], // Verificar role (0 = Cliente, 1 = Gerente)
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,  // Adicionando a role ao usuário
        ]);

        // Dispara o evento Registered (opcional)
        event(new Registered($user));

        // Login automático após registro
        Auth::login($user);

        // Redirecionamento após login - dependente da role
        if ($user->role == "admin") {
            // Se for gerente, redireciona para a área de administração
            return redirect()->route('admin.dashboard');
        } elseif($user->role == "cliente") {
            // Se for cliente, redireciona para a área do cliente
            return redirect()->route('cliente.dashboard');
        }
    }
}
