<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\ProduitCat;
use App\Models\Compte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {

        $bool = false;
        $produits = Produit::query();
        $categories = ProduitCat::all();
        $comptes = Compte::all();

        // Filter by id_compte
        if ($request->id_compte!='') {
            $bool = true;
            $produits->where('id_compte',"=", $request->input('id_compte'));
        }

        // Filter by id_cat
        if ($request->id_cat!='') {
             $bool = true;
            $produits->where('id_cat',"=", $request->input('id_cat'));
        }

        if ($bool) {
            $produits = $produits->get();
            return view('produits.index', ['categories' => $categories , 'comptes' => $comptes, 'produits' => $produits]);
        }else{
            $produits = Produit::paginate(5);
            return view('produits.index', ['categories' => $categories , 'comptes' => $comptes, 'produits' => $produits]);
        }

    }

    public function create()
    {
        $categories = ProduitCat::where('deleted_at','=',null)->get();
        $comptes = Compte::where('deleted_at','=',null)->get();
        return view('produits.create', ['categories' => $categories , 'comptes' => $comptes]);
    }

    public function store(Request $request)
    {
        $produit = new Produit;
        $produit->name = $request->input('name');
        $produit->id_cat = $request->input('id_cat');
        $produit->id_compte = $request->input('id_compte');
        $produit->save();

        return redirect()->route('produits.index');
    }

    public function edit($id)
    {
        $categories = ProduitCat::all();
        $comptes = Compte::all();
        $produit = Produit::findOrFail($id);

        return view('produits.edit', ['produit' => $produit, 'categories' => $categories , 'comptes' => $comptes]);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->name = $request->input('name');
        $produit->id_cat = $request->input('id_cat');
        $produit->id_compte = $request->input('id_compte');
        $produit->save();

        return redirect()->route('produits.index');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index');
    }
}
