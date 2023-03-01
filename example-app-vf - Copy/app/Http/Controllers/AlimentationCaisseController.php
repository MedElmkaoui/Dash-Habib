<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Caisse;
use App\Models\AlimentationCaisse;
use Illuminate\Http\Request;

class AlimentationCaisseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $bool = false;
        $alimentationsCaisse = AlimentationCaisse::where('deleted_at', null)->paginate(5);
        $users = User::where('deleted_at', null)->get();

        // Filter by date
        if ($request->date!='') {
            $bool = true;
            $alimentationsCaisse->where('date', $request->input('date'));
       }

       // Filter by montant
       if ($request->montant!='') {
            $bool = true;
            $alimentationsCaisse->where('montant',"LIKE", '%'.$request->input('montant').'%');
       }

       // Filter by id_user
       if ($request->id_user!='') {
            $bool = true;
            $alimentationsCaisse->where('id_user', $request->input('id_user'));
        }

       // Filter by id_user_donneur
       if ($request->id_user_donneur!='') {
            $bool = true;
            $alimentationsCaisse->where('id_user_donneur', $request->input('id_user_donneur'));
        }

        if ($bool) {
            $alimentationsCaisse = $alimentationsCaisse->where("deleted_at", null)->latest()->paginate(5);
            if (Auth::user()->type != 'Admin') {
                $alimentationsCaisse = $alimentationsCaisse->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }
            return view('alimentations_caisse.index', [ 'comptes'=> $comptes, 'alimentationsCaisse'=> $alimentationsCaisse, 'users' => $users ]); 
        }else{
            
            if (Auth::user()->type != 'Admin') {
                $alimentations = $alimentations->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }else{
                $alimentations = AlimentationCaisse::where("deleted_at", null)->latest()->paginate(5);
            }
            return view('alimentations_caisse.index', [ 'alimentations'=> $alimentations, 'users' => $users ]);
        }
    }

    public function create()
    {
        
        $users = User::where('deleted_at', null)->get();
        return view('alimentations_caisse.create',['users' => $users ]);
    }

    public function store(Request $request)
    {

        if(Auth::user()->id == $request->id_user_donneur){
            return redirect()->back()->with('Error', "Accès refusé: Vous ne pouvez pas demander votre propre alimentation.");
        }

        $caisse_donneur = Caisse::where('id_user', $request->id_user_donneur)->first();
        $caisse_demendeur =  Auth::user()->caisse;

        if($caisse_donneur == null ){
            return redirect()->back()->with('Error', "Accès refusé: Votre Donneur il a pas une Caisse");
        }
        if($caisse_demendeur == null){
            return redirect()->back()->with('Error', "Accès refusé: Vou avez pas une Caisse");
        }

        $alimentation = new AlimentationCaisse;
        $alimentation->id_user = Auth::user()->id ;
        $alimentation->date = now();
        $alimentation->id_user_donneur = $request->id_user_donneur;
        $alimentation->montant = $request->montant;
        $alimentation->confirmation = false;
        $alimentation->save();

        return redirect()->route('alimentations-caisse.index');
    }

    public function show(AlimentationCaisse $alimentation)
    {
        return view('alimentations_caisse.show', compact('alimentation'));
    }

    public function edit(AlimentationCaisse $alimentation)
    {
        return view('alimentations_caisse.edit', compact('alimentation'));
    }

    public function update(Request $request, AlimentationCaisse $alimentation)
    {
        $alimentation->date = $request->date;
        $alimentation->id_user = $request->id_user;
        $alimentation->id_user_donneur = $request->id_user_donneur;
        $alimentation->montant = $request->montant;
        $alimentation->confirmation = $request->confirmation;
        $alimentation->save();
    
        return redirect()->route('alimentations-caisse.index');
    }
    
    public function destroy(AlimentationCaisse $alimentation)
    {
        $alimentation->delete();
    
        return redirect()->route('alimentations-caisse.index');
    }
}
