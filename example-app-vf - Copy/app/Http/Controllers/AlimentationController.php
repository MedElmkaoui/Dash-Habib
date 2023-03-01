<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Alimentation;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlimentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {

        $bool = false;
        $alimentations = Alimentation::query();
        $users = User::where("deleted_at", null)->get();
        $comptes = Compte::where("deleted_at", null)->get();

        // Filter by date
        if ($request->date!='') {
            $bool = true;
            $alimentations->where('date', $request->input('date'));
       }

       // Filter by montant
       if ($request->montant!='') {
            $bool = true;
            $alimentations->where('montant',"LIKE", '%'.$request->input('montant').'%');
       }

       // Filter by id_user
       if ($request->id_user!='') {
            $bool = true;
            $alimentations->where('id_user', $request->input('id_user'));
        }

       // Filter by id_compte
       if ($request->id_compte!='') {
            $bool = true;
            $alimentations->where('id_compte', $request->input('id_compte'));
        }

        if ($bool) {
            $alimentations = $alimentations->where("deleted_at", null)->latest()->paginate(5);
            if (Auth::user()->type != 'Admin') {
                $alimentations = $alimentations->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }
            return view('alimentations.index', [ 'comptes'=> $comptes, 'alimentations'=> $alimentations, 'users' => $users ]); 
        }else{
            
            if (Auth::user()->type != 'Admin') {
                $alimentations = $alimentations->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }else{
                $alimentations = Alimentation::where("deleted_at", null)->latest()->paginate(5);
            }
            return view('alimentations.index', [ 'comptes'=> $comptes, 'alimentations'=> $alimentations, 'users' => $users ]);
        }

    }

    public function create()
    {
        $users = User::all();
        $comptes = Compte::all(); 

        return view('alimentations.create', [ "users"=> $users, "comptes" => $comptes ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
            'montant' => 'required|numeric|min:0',
            'id_user' => 'required|exists:users,id',
            'id_compte' => 'required|exists:comptes,id',
        ]);

        $alimentation = Alimentation::create($validatedData);
        // Update Sold of compte
        $compte = Compte::findOrFail($alimentation->id_compte);
        $compte->sold = $compte->sold + $request->montant ;
        $compte->update();

        return redirect()->route('alimentations.index');
    }


   /* public function edit(Alimentation $alimentation)
    {
        $users = User::all();
        $comptes = Compte::all(); 
        return view('alimentations.edit', [ "users"=> $users, "comptes" => $comptes, 'alimentation'=> $alimentation ]);
    }

    public function show(Request $request, Alimentation $alimentation)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
            'montant' => 'required|numeric|min:0',
            'id_user' => 'required|exists:users,id',
            'id_compte' => 'required|exists:comptes,id',
        ]);

        $alimentation->update($validatedData);
        return redirect()->route('alimentations.index');
    }*/

    public function destroy(Alimentation $alimentation)
    {


        $alimentation->deleted_at = now();
        $alimentation->save();

        // Update Sold of compte
        $compte = Compte::findOrFail($alimentation->id_compte);
        $compte->sold = $compte->sold - $alimentation->montant ;
        $compte->update();

        return redirect()->route('alimentations.index');
    }
}
