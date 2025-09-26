<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LoginRegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', only: ['login', 'authenticate']),

            new Middleware('auth', only: ['home', 'logout', 'register', 'store']),
        ];
    }

    public function register(): View
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Acesso negado.');
        }

        return view('auth.register');
    }
    
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('home')
            ->withSuccess('Usuário criado com sucesso!');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'As credenciais não conferem.',
        ])->onlyInput('email');
    }
    
    public function home(): View
    {
        return view('auth.home');
    } 
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Você saiu com sucesso!');
    }
}
