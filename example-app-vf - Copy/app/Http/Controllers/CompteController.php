<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {
        
        $bool = false;
        $comptes = Compte::query();

         // Filter by name
        if ($request->name!='') {
            $bool = true;
            $comptes->where('name', $request->input('name'));
        }

        // Filter by n_compte
        if ($request->n_compte!='') {
             $bool = true;
            $comptes->where('n_compte', $request->input('n_compte'));
        }
        // Filter by adresse
        if ($request->adresse!='') {
             $bool = true;
            $comptes->where('adresse', $request->input('adresse'));
        }
        // Filter by tel
        if ($request->tel!='') {
             $bool = true;
            $comptes->where('tel', $request->input('tel'));
        }
        // Filter by sold
        if ($request->sold!='') {
             $bool = true;
            $comptes->where('sold', $request->input('sold'));
        }

        if ($bool) {
            $comptes = $comptes->get();
            return view('comptes.index', ['comptes' => $comptes]);
        }else{
            $comptes = Compte::latest()->get();
            return view('comptes.index', ['comptes' => $comptes]);
        }
    }

    public function create()
    {
        return view('comptes.create');
    }

    public function store(Request $request)
    {
        $compte = new Compte;
        $compte->name = $request->input('name');
        $compte->n_compte = $request->input('n_compte');
        $compte->adr = $request->input('adr');
        $compte->tel = $request->input('tel');
        $compte->sold = $request->input('sold');
        $compte->save();

        return redirect()->route('comptes.index');
    }

    public function show($id)
    {
        $compte = Compte::findOrFail($id);
        return view('comptes.show', ['compte' => $compte]);
    }

    public function edit($id)
    {
        $compte = Compte::findOrFail($id);
        return view('comptes.edit', ['compte' => $compte]);
    }

    public function update(Request $request, $id)
    {
        $compte = Compte::findOrFail($id);
        $compte->name = $request->input('name');
        $compte->n_compte = $request->input('n_compte');
        $compte->adr = $request->input('adr');
        $compte->tel = $request->input('tel');
        $compte->sold = $request->input('sold');
        $compte->save();

        return redirect()->route('comptes.index');
    }

    public function destroy($id)
    {
        $compte = Compte::findOrFail($id);
        $compte->delete();

        return redirect()->route('comptes.index');
    }
}
