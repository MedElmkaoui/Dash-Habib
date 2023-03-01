<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Charge;
use App\Models\ChargeCat;
use App\Models\Agency;
use App\Models\User;
use App\Models\Caisse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $bool = false;
        $charges = Charge::query();

        $users = User::all();
        $charges_cats = ChargeCat::all();
        $agencies = Agency::all();
       
        // Filter by id_ag
        if ($request->id_ag != '') {
            $bool = true;
            $charges->where('id_ag', $request->id_ag);
        }

        // Filter by label
        if ($request->label != '') {
            $bool = true;
            $charges->where('label', 'LIKE', '%'.$request->label.'%');
        }

        // Filter by date
        if ($request->date != '') {
             $bool = true;
            $charges->where('date','LIKE', '%'.$request->date.'%');
        }

        // Filter by montant
        if ($request->montant != '') {
             $bool = true;
            $charges->where('montant','LIKE', '%'.$request->montant.'%');
        }

        // Filter by id_cat
        if ($request->id_cat != '') {
             $bool = true;
            $charges->where('id_cat', $request->id_cat);
        }

        // Filter by id_user
        if ($request->id_user != '') {
             $bool = true;
            $charges->where('id_user', $request->id_user);
        }


        if ($bool) {
            if (Auth::user()->type !='Admin') {
                $charges = $charges->where('id_user', Auth::user()->id)->latest()->paginate(5);
            } else {
                $charges = $charges->latest()->paginate(5);
            }
            
            
            return view('charges.index', [ 'charges'=> $charges, 'users'=> $users, 'charges_cats'=> $charges_cats, 'agencies'=> $agencies ]);

        }else{

            if (Auth::user()->type !='Admin') {
                $charges = Charge::with('agency', 'category', 'user')->where('id_user', Auth::user()->id)->latest()->paginate(5);
            } else {
                $charges = Charge::with('agency', 'category', 'user')->latest()->paginate(5);
            }
            
            return view('charges.index', [ 'charges'=> $charges, 'users'=> $users, 'charges_cats'=> $charges_cats, 'agencies'=> $agencies ]);
        }

        
    }

    public function create()
    {
        $charges_cats = ChargeCat::where('deleted_at',null)->get();
        $agencies = Agency::where('deleted_at',null)->get();
        $users = User::where('deleted_at',null)->get();
        return view('charges.create', [ 'charges_cats'=> $charges_cats, 'agencies' =>$agencies, 'users'=>$users ]);
    }

    public function store(Request $request)
    {

        $charge = new Charge;
        $charge->label = $request->label;
        $charge->id_ag = $request->id_ag;
        if ($request->id_ag =='') {
            if (Auth::user()->caisse == null) {
                return redirect()->back()->with('error', "Vous n'avez pas de caisse. Veuillez contacter l'administrateur pour obtenir une caisse.");
            }
            $charge->id_ag = Auth::user()->caisse->id_ag;
        }
        
        $charge->id_cat = $request->id_cat;
        $charge->montant = $request->montant;
        $charge->date = $request->date;
        if ($request->date =='') {
            $charge->date = now();
        }
        
        $charge->id_user = $request->id_user;
        if ($request->id_user =='') {
            $charge->id_user = Auth::user()->id;
        }
        $charge->note = $request->note;
        if ($request->note =='') {
            $charge->note = 'Aucun Note';
        }
        $charge->save();

        if (Auth::user()->caisse != null) {

            $caisse = Caisse::findOrFail(Auth::user()->caisse->id);
            $caisse->sold_d -= $request->montant;

            $caisse->update();
        }
        
        
        return redirect()->route('charges.index');
    }

   /* public function edit(Charge $charge)
    {
        $charges_cats = ChargeCat::all();
        $agencies = Agency::all();
        $users = User::all();
        return view('charges.edit', [ 'charge'=> $charge, 'charges_cats'=> $charges_cats, 'agencies' =>$agencies, 'users'=>$users ]);
    }

    public function update(Request $request, Charge $charge)
    {
        $charge->update($request->all());

        return redirect()->route('charges.index');
    }*/

    public function destroy(Charge $charge)
    {
        $charge->delete();

        return redirect()->route('charges.index');
    }
}
