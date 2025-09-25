<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::latest()->paginate(5);
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'formaPgto' => 'required|string|max:255',
            'dataCompra' => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_produtos', 'public');
        }

        Produto::create($validated);

        return redirect()->route('produtos.index')
                         ->with('success','Produto criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'formaPgto' => 'required|string|max:255',
            'dataCompra' => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_produtos', 'public');
        }

        $produto->update($validated);

        return redirect()->route('produtos.index')
                         ->with('success','Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')
                         ->with('success','Produto removido com sucesso.');
    }

    /* --- NOVOS MÉTODOS PARA COMPRA --- */
    public function compra(Produto $produto)
    {
        return view('produtos.compra', compact('produto'));
    }

    public function processarCompra(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'formaPgto' => 'required|string|max:255',
            'dataCompra' => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_produtos', 'public');
        }

        $produto->update($validated);

        return redirect()->route('produtos.show', $produto->id)
                         ->with('success','Compra registrada com sucesso.');
    }
}
