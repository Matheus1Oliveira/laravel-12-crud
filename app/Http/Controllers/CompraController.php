<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    private function authorizeUser()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'É necessário estar logado para acessar essa página.')
                ->send();
        }
    }

    public function index()
    {
        $compras = Compra::latest()->paginate(5);
        return view('compras.index', compact('compras'));
    }

    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    public function create()
    {
        $this->authorizeUser();

        return view('compras.create');
    }

    public function store(Request $request)
    {
        $this->authorizeUser();

        $validated = $request->validate([
            'formaPgto'   => 'required|string|max:255',
            'dataCompra'  => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs'         => 'nullable|string',
            'foto'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_compras', 'public');
        }

        Compra::create($validated);

        return redirect()->route('compras.index')
                         ->with('success','Compra criada com sucesso.');
    }

    public function edit(Compra $compra)
    {
        $this->authorizeUser();

        return view('compras.edit', compact('compra'));
    }

    public function update(Request $request, Compra $compra)
    {
        $this->authorizeUser();

        $data = $request->validate([
            'formaPgto'   => 'required|string|max:255',
            'dataCompra'  => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs'         => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($compra->foto && Storage::disk('public')->exists($compra->foto)) {
                Storage::disk('public')->delete($compra->foto);
            }
            $data['foto'] = $request->file('foto')->store('compras', 'public');
        }

        $compra->update($data);

        return redirect()->route('compras.index')->with('success', 'Compra atualizada com sucesso!');
    }

    public function destroy(Compra $compra)
    {
        $this->authorizeUser();

        if ($compra->foto && Storage::disk('public')->exists($compra->foto)) {
            Storage::disk('public')->delete($compra->foto);
        }

        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra excluída com sucesso!');
    }
}
