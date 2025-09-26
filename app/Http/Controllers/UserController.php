<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Verificar se é admin (reutilizado em todos os métodos).
     */
    private function authorizeAdmin()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'É necessário estar logado para acessar esta página.')
                ->send();
        }

        if (!Auth::user()->is_admin) {
           return redirect('/')
                ->with('error', 'Você não tem permissão para acessar esta página.')
                ->send();
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $users = User::latest()->paginate(5);

        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'     => 'required|string|max:250',
            'email'    => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('users', 'public');
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário registrado com sucesso!');
    }

    public function show(User $user)
    {
        $this->authorizeAdmin();

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorizeAdmin();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $validated['foto'] = $request->file('foto')->store('users', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
