<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::latest()->paginate(5);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        return view('compras.create');
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
            $validated['foto'] = $request->file('foto')->store('fotos_compras', 'public');
        }

        Compra::create($validated);

        return redirect()->route('compras.index')
                         ->with('success','Compra criado com sucesso.');
    }

    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        return view('compras.edit', compact('compra'));
    }

    public function update(Request $request, Compra $compra)
    {
        $data = $request->validate([
            'formaPgto'   => 'required|string|max:255',
            'dataCompra'  => 'required|date',
            'dataRecebto' => 'nullable|date',
            'obs'         => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Se já existe foto antiga, apaga antes
            if ($compra->foto && Storage::disk('public')->exists($compra->foto)) {
                Storage::disk('public')->delete($compra->foto);
            }

            // Salva a nova
            $data['foto'] = $request->file('foto')->store('compras', 'public');
        }

        $compra->update($data);

        return redirect()->route('compras.index')->with('success', 'Compra atualizado com sucesso!');
    }


    public function destroy(Compra $compra)
    {
        if ($compra->foto && Storage::disk('public')->exists($compra->foto)) {
            Storage::disk('public')->delete($compra->foto);
        }

        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra excluído com sucesso!');
    }


}
