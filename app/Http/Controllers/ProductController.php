<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function authorizeUser()
    {
        if (!Auth::check()) {
            return redirect('/')
                ->with('error', 'É necessário estar logado para acessar essa página.')
                ->send();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorizeUser();

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->authorizeUser();

        Product::create($request->validated());

        return redirect()->route('products.index')
            ->withSuccess('Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $this->authorizeUser();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorizeUser();

        $product->update($request->validated());

        return redirect()->back()
            ->withSuccess('Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorizeUser();

        $product->delete();

        return redirect()->route('products.index')
            ->withSuccess('Produto excluído com sucesso!');
    }
}
