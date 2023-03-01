<?php

namespace App\Http\Controllers;

use App\Models\ProduitCat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $produitCats = ProduitCat::where('deleted_at',"=", null)->get();
        return view('produit-cats.index', compact('produitCats'));
    }

    public function create()
    {
        return view('produit-cats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'in_out' => 'required|max:255',
        ]);

        
        $produitCat = new ProduitCat;
        $produitCat->name = $request->name;
        $produitCat->in_out = $request->in_out;
       
        $produitCat->save();

        return redirect()->route('produit-cats.index');
        
    }

    public function edit(ProduitCat $produitCat)
    {
        return view('produit-cats.edit', compact('produitCat'));
    }

    public function update(Request $request, ProduitCat $produitCat)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $produitCat->update($request->all());

        return redirect()->route('produit-cats.index')
            ->with('success', 'Produit category updated successfully.');
    }

    public function destroy(ProduitCat $produitCat)
    {
        $produitCat->deleted_at = now();
        $produitCat->save();

        return redirect()->route('produit-cats.index')
            ->with('success', 'Produit category deleted successfully.');
    }
}
