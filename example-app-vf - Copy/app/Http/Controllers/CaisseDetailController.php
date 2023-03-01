<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\CaisseDetail;
use App\Models\Caisse;
use App\Models\Operation;
use App\Models\Charge;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaisseDetailController extends Controller
{
    public function index(Request $request)
    {
        $bool = false;
        $caisseDetails = CaisseDetail::query();
        $caisses= Caisse::where('deleted_at',null)->get();

        // Filter by id_caisse
        if ($request->id_caisse!='') {
            $bool = true;
           $caisseDetails->where('id_caisse', $request->input('id_caisse'));
       }

       // Filter by date
       if ($request->date!='') {
            $bool = true;
           $caisseDetails->where('date', $request->input('date'));
       }

       

       if ($bool) {
            $caisseDetails = $caisseDetails->where('deleted_at',null)->latest()->paginate(5);
            if (Auth::user()->type != 'Admin') {
                $caisseDetails = $caisseDetails->where("id_user",Auth::user()->id)->latest()->paginate(5);
            }
            return view('caisse-details.index', ["caisseDetails"=>$caisseDetails, "caisses" => $caisses]);
        }else{
            
            if (Auth::user()->type != 'Admin') {
                $caisseDetails = $caisseDetails->where('deleted_at',null)->where("id_user",Auth::user()->id)->latest()->paginate(5);
            }else{
                $caisseDetails = CaisseDetail::where('deleted_at',null)->latest()->paginate(5);
            }
            return view('caisse-details.index', ["caisseDetails"=>$caisseDetails, "caisses" => $caisses]);
        }
    }

    public function create()
    {

        $now = Carbon::now();

        $caisses = Caisse::where('deleted_at',null)->get();
        //$caisseDetails =  CaisseDetail::where('date', now());
        //if(count($caisseDetails)!= 0)
        //{
            //return redirect()->back();
        //}

        $operations = Operation::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->whereDate('date', $now)
        ->get();

        $TotalOperationIn = Operation::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->where('in_out', "In")
        ->whereDate('date', $now)
        ->sum('montant','cost') + Operation::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->where('in_out', "In")
        ->whereDate('date', $now)
        ->sum('cost');

        $TotalOperationOut = Operation::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->where('in_out', "Out")
        ->whereDate('date', $now)
        ->sum('montant','cost') + Operation::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->where('in_out', "Out")
        ->whereDate('date', $now)
        ->sum('cost');

        $TotalCharges = Charge::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->whereDate('date', $now)
        ->sum('montant');

        $charges = Charge::where('deleted_at', null)
        ->where('id_user', Auth::user()->id)
        ->whereDate('date', $now)
        ->get();


        if(Auth::user()->caisse == null){
            return redirect()->back()->with("Error", "Accès refusé: Vous n'avez pas de caisse.");
        }else{
            $sold_final = Auth::user()->caisse->sold_d;
        }
        


        return view('caisse-details.create',["operations"=>$operations, 
        "charges"=>$charges, 
        "TotalOperationIn"=>$TotalOperationIn,
        "TotalOperationOut"=>$TotalOperationOut,
        "TotalCharges"=>$TotalCharges,
        "sold_final"=>$sold_final,]);
    }

    public function store(Request $request)
    {
        $caisses = Caisse::all();
        $caisseDetails =  CaisseDetail::all();
        $validatedData = $request->validate([
            'n_200' => 'required|integer|min:0',
            'n_100' => 'required|integer|min:0',
            'n_50' => 'required|integer|min:0',
            'n_20' => 'required|integer|min:0',
            'n_10' => 'required|integer|min:0',
            'n_5' => 'required|integer|min:0',
            'n_2' => 'required|integer|min:0',
            'n_1' => 'required|integer|min:0',
            'n_05' => 'required|integer|min:0',
            'n_04' => 'required|integer|min:0',
            'n_02' => 'required|integer|min:0',
        ]);

        $caisseDetail = new CaisseDetail;
        $caisseDetail->n_200 = $request->n_200;
        $caisseDetail->n_100 = $request->n_100;
        $caisseDetail->date = $request->date;
        if ($request->date == '') {
            $caisseDetail->date = now();
        }
        $caisseDetail->n_50 = $request->n_50;
        $caisseDetail->n_20 = $request->n_20;
        $caisseDetail->n_10 = $request->n_10;
        $caisseDetail->n_5 = $request->n_5;
        $caisseDetail->n_2 = $request->n_2;
        $caisseDetail->n_1 = $request->n_1;
        $caisseDetail->n_05 = $request->n_05;
        $caisseDetail->n_04 = $request->n_04;
        $caisseDetail->n_02 = $request->n_02;
        $caisseDetail->sold_total = $request->sold_total;
        $caisseDetail->id_caisse = Auth::user()->caisse->id;
        $caisseDetail->save();

        return view('caisse-details.index',["caisseDetails"=>$caisseDetails, "caisses"=>$caisses]);

    }

    public function show(CaisseDetail $caisseDetail)
    {
        $caisses = Caisse::all();
        return view('caisse-details.show', ["caisseDetail"=>$caisseDetail, "caisses" => $caisses]);
    }

    public function edit(CaisseDetail $caisseDetail)
    {
        return view('caisse-details.edit', compact('caisseDetail'));
    }

    public function update(Request $request, CaisseDetail $caisseDetail)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'id_caisse' => 'required|exists:caisses,id',
            'n_200' => 'required|integer|min:0',
            'n_100' => 'required|integer|min:0',
            'n_50' => 'required|integer|min:0',
            'n_20' => 'required|integer|min:0',
            'n_10' => 'required|integer|min:0',
            'n_5' => 'required|integer|min:0',
            'n_2' => 'required|integer|min:0',
            'n_1' => 'required|integer|min:0',
            'n_05' => 'required|integer|min:0',
            'n_04' => 'required|integer|min:0',
            'n_02' => 'required|integer|min:0',
        ]);

        $caisseDetail->update($validatedData);
        return redirect()->route('caisse-details.show', $caisseDetail);
    }

    public function destroy(CaisseDetail $caisseDetail)
    {
        $caisseDetail->delete();
        return redirect()->route('caisse-details.index');
    }
}
