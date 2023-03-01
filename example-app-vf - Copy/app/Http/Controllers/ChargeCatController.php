<?php

namespace App\Http\Controllers;

use App\Models\ChargeCat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChargeCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $chargeCats = ChargeCat::all();
        return view('chargeCats.index', compact('chargeCats'));
    }

    public function create()
    {
        return view('chargeCats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chargeCat = new ChargeCat();
        $chargeCat->name = $request->name;
        $chargeCat->save();

        return redirect()->route('chargeCats.index')
            ->with('success', 'Charge category created successfully.');
    }

    public function edit($id)
    {
        $chargeCat = ChargeCat::findOrFail($id);
        return view('chargeCats.edit', compact('chargeCat'));
    }

    public function update(Request $request, $id)
    {
        $chargeCat = ChargeCat::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chargeCat->name = $request->name;
        $chargeCat->save();

        return redirect()->route('chargeCats.index')
            ->with('success', 'Charge category updated successfully.');
    }

    public function destroy( $id)
    {
        $chargeCat = ChargeCat::findOrFail($id);
        $chargeCat->delete();
        return redirect()->route('chargeCats.index')
            ->with('success', 'Charge category deleted successfully.');
    }
}
