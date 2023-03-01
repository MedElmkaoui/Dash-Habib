<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Caisse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {

        $bool = false;
        $agencies = Agency::query();
        $users= User::all();

        // Filter by code_ag
        if ($request->code_ag!='') {
            $bool = true;
            $agencies->where('code_ag',"LIKE", '%'.$request->input('code_ag').'%');
        }

        // Filter by adr
        if ($request->adr!='') {
             $bool = true;
            $agencies->where('adr',"LIKE", '%'.$request->input('adr').'%');
        }

        // Filter by fix
        if ($request->fix!='') {
             $bool = true;
            $agencies->where('fix',"LIKE", '%'.$request->input('fix').'%');
        }

        // Filter by id_user
        if ($request->id_user!='') {
             $bool = true;
            $agencies->where('id_user',"=", $request->input('id_user'));
        }

        // Filter by sold_d
        if ($request->sold_d!='') {
             $bool = true;
            $agencies->where('sold_d',"LIKE", '%'.$request->input('sold_d').'%');
        }

        if ($bool) {
            $agencies = $agencies->get();
            return view('agencies.index', ['agencies' => $agencies , 'users' => $users]);
        }else{
            $agencies = Agency::latest()->get();
            return view('agencies.index', ['agencies' => $agencies , 'users' => $users]);
        }
    }

    public function create()
    {
        $users= User::all();
        return view('agencies.create', compact('users'));
    }

    public function show($id)
    {
        $users = User::where('deleted_at',null)->get();
        $agencies = Agency::where('deleted_at',null)->get();


        $caisses = Caisse::where('deleted_at',null)->where('id_ag',$id)->latest()->paginate(5);
        return view('caisses.index', [ "users" => $users, "agencies" => $agencies, "caisses" => $caisses ]);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_ag' => 'required|unique:agencies',
            'adr' => 'required',
            'fix' => 'required',
            'id_user' => 'nullable|exists:users,id',
        ]);

        $agencies = Agency::where('deleted_at',null)->where('id_user',$request->id_user)->get();

        if(count($agencies)==0){
            $agency = new Agency;
            $agency->code_ag = $request->code_ag;
            $agency->adr = $request->adr;
            $agency->fix = $request->fix;
            $agency->id_user = $request->id_user;
            $agency->sold_d = 0.00;

            $agency->save();
            return redirect()->route('agencies.index')->with('success', 'Agency created successfully.');
        }else{
            return redirect()->back()->with('Error', "Erreur : Cet utilisateur est responsable d'une autre agence.");
        }

        
    }

    public function edit(Agency $agency)
    {
        $users= User::all();
        return view('agencies.edit', ['users' => $users, 'agency' => $agency]);
    }

    public function update(Request $request, Agency $agency)
    {
        $validated = $request->validate([
            'code_ag' => 'required|unique:agencies,code_ag,'.$agency->id,
            'adr' => 'required',
            'fix' => 'required',
            'id_user' => 'nullable|exists:users,id',
            'sold_d' => 'required|numeric',
        ]);

        $agency->update($validated);

        return redirect()->route('agencies.index')->with('success', 'Agency updated successfully.');
    }

    public function destroy(Agency $agency)
    {
        $agency->delete();
        return redirect()->route('agencies.index')->with('success', 'Agency deleted successfully.');
    }
}
