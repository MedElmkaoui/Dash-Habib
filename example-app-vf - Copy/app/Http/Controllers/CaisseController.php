<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaisseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {

        $bool = false;
        $caisses = Caisse::query();
        $users = User::all();
        $agencies = Agency::all();

        // Filter by code_caisse
        if ($request->code_caisse!='') {
            $bool = true;
            $caisses->where('code_caisse',"LIKE", '%'.$request->input('code_caisse').'%');
        }
        // Filter by id_ag
        if ($request->id_ag!='') {
             $bool = true;
            $caisses->where('id_ag',"=", $request->input('id_ag'));
        }
        // Filter by sold_d
        if ($request->sold_d!='') {
             $bool = true;
            $caisses->where('sold_d',"LIKE", "%".$request->input('sold_d')."%");
        }
        // Filter by id_user
        if ($request->id_user!='') {
             $bool = true;
            $caisses->where('id_user',"=", $request->input('id_user'));
        }

        if ($bool) {

            $caisses = $caisses->where('deleted_at',null)->paginate(5);
            return view('caisses.index', [ "users" => $users, "agencies" => $agencies, "caisses" => $caisses ]);

        }else{

            $caisses = Caisse::where('deleted_at',null)->latest()->paginate(5);
            return view('caisses.index', [ "users" => $users, "agencies" => $agencies, "caisses" => $caisses ]);

        }
    }


    public function create()
    {
        $users = User::all();
        $agencies = Agency::all();
        return view('caisses.create', [ "users" => $users, "agencies" => $agencies ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_caisse' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_ag' => 'required|exists:agencies,id',
            'sold_d' => 'required|numeric',
        ]);

        $caisse = Caisse::create($validated);
        $agency = Agency::find($request->id_ag);
        $agency->sold_d += $request->sold_d;
        $agency->update();

        return redirect()->route('caisses.index')->with('success', 'Caisse created successfully.'); 
    }

    public function edit($id)
    {
        $caisse = Caisse::findOrFail($id);
        $users = User::all();
        $agencies = Agency::all();

        return view('caisses.edit',[ "users" => $users, "agencies" => $agencies, "caisse"=> $caisse ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'code_caisse' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_ag' => 'required|exists:agencies,id',
            'sold_d' => 'required|numeric',
        ]);
        
        $caisse = Caisse::findOrFail($id);
        $caisse->update($validated);
        return redirect()->route('caisses.index')->with('success', 'Caisse updated successfully.');
    }

    public function destroy($id)
    {
        $caisse = Caisse::findOrFail($id);

        // Delete the caisse
        $caisse->delete();

        return redirect()->route('caisses.index')->with('success', 'Caisse deleted successfully.');
    }
}
