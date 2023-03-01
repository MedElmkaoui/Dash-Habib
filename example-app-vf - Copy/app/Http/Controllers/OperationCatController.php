<?php

namespace App\Http\Controllers;

use App\Models\OperationCat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OperationCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $cats = OperationCat::all();
        return view('operation_cats.index', compact('cats'));
    }

    public function create()
    {
        return view('operation_cats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:operation_cats'],
        ]);

        $cat = new OperationCat;
        $cat->name = $request->name;

        $cat->save();
        

        return redirect()->route('operation-cats.index')->with('success', 'Operation category created successfully!');
    }

    public function edit($id)
    {
        $cat = OperationCat::findOrFail($id);
        return view('operation_cats.edit', compact('cat'));
    }

    public function update(Request $request,  $id)
    {
        $cat = OperationCat::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'unique:operation_cats,name,'.$cat->id], 
        ]);

        $cat->update($request->all());

        return redirect()->route('operation-cats.index')->with('success', 'Operation category updated successfully!');
    }

    public function destroy( $id)
    {
        $cat = OperationCat::findOrFail($id);
        $cat->delete();

        return redirect()->route('operation-cats.index')->with('success', 'Operation category deleted successfully!');
    }
}
