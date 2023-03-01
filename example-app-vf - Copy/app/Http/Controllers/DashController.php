<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Dash;
use App\Models\Charge;
use App\Models\Produit;
use App\Models\User;
use App\Models\Agency;
use App\Models\Compte;
use App\Models\Operation;
use App\Models\CaisseDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashController extends Controller
{
    public function __construct()
    {
        if(count(User::all())==0){
            $user = new User;
            $user->name = "Habib";
            $user->cin = "Admin";
            $user->email = "Admin@gmail.com";
            $user->date_rec = date("Y/m/d");
            $user->type = "Admin";
            $user->password = bcrypt("Admin");
            $user->save();
        }
        $this->middleware('auth');
        $this->middleware('admin');
        
    }

    public function index()
    {
        $comptes = Compte::all();
        $topProducts = Produit::select('produits.id', 'produits.name', 'produits.id_cat', 'produits.id_compte', DB::raw('COUNT(operations.id) as count'), DB::raw('SUM(operations.montant + operations.cost) as total_montant'))
        ->join('operations', 'operations.id_prod', '=', 'produits.id')
        ->groupBy('produits.id', 'produits.name', 'produits.id_cat', 'produits.id_compte')
        ->having('count', '>', 1)
        ->orderByDesc('count')
        ->limit(10)
        ->get();

        $topUsers = User::select('users.name', DB::raw('COUNT(operations.id) as count'), DB::raw('SUM(operations.montant + operations.cost) as total_montant'))
        ->join('operations', 'operations.id_user', '=', 'users.id')
        ->groupBy('users.name')
        ->having('count', '>', 1)
        ->orderByDesc('count')
        ->limit(10)
        ->get();

        $agencies = Agency::where('deleted_at',null)->get();
        $soldAgencies = Agency::where('deleted_at',null)->sum('sold_d');
        $totalCharge = Charge::where('deleted_at',null)->sum('montant');
        $totalCompte = Compte::where('deleted_at',null)->sum('sold');
        $totalBenefit = Operation::where('deleted_at',null)->where('date',date('Y-m-d'))->sum('montant') + Operation::where('date',date('Y-m-d'))->where('deleted_at',null)->sum('cost');
        return view('dash.index', [ 
            'totalBenefit' => $totalBenefit, 
            'totalCharge'=> $totalCharge,  
            'agencies'=> $agencies, 
            'comptes'=> $comptes, 
            'soldAgencies'=> $soldAgencies, 
            'topProducts'=> $topProducts,
            'totalCompte'=> $totalCompte,
            'topUsers'=> $topUsers,
        ]);

    }

    public function getBenefitsByAgency(Request $request){

        
        if ($request->code_ag == "") {
            $agencies_sold = Agency::all()->sum('sold_d');
            
        }else{
            
            $agencies_sold = Agency::where('code_ag', $request->code_ag)->sum('sold_d');
            
        }
        
        
        if ($agencies_sold !="") {
            return response()->json($agencies_sold);
        }
    }


    public function getchargesByAgency(Request $request){

        
        if ($request->code_ag == "") {
            $agencies_sold = Charge::all()->sum('montant');
            
        }else{
            $agencies_sold = Charge::where('id_ag', $request->code_ag)->sum('montant');
        }
        
        
        if ($agencies_sold !="") {
            return response()->json($agencies_sold);
        }
    }

    public function getSoldByCompte(Request $request){

        
        if ($request->id_compte == "") {
            $compte_sold = Compte::all()->sum('sold');
            
        }else{
            $compte_sold = Compte::where('id', $request->id_compte)->sum('sold');
        }
        
        if ($compte_sold !="") {
            return response()->json($compte_sold);
        }
    }

    public function getDataForGraph(Request $request){

        // Get the agency ID you want to filter by
        $agencyId = $request->id_ag;

        // Get the current year
        $currentYear = date('Y');

        // Query operations for the given agency and year, grouped by month and operation type, and sum the cost and montant
        $outOperations = Operation::select(DB::raw('MONTH(date) as month'), DB::raw('SUM(cost + montant) as total'))
            ->where('id_ag', $agencyId)
            ->where('in_out', 'Out')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->toArray();

        $maxTotal = Operation::max(DB::raw('montant + cost'));

        $inOperations = Operation::select(DB::raw('MONTH(date) as month'), DB::raw('SUM(cost + montant) as total'))
            ->where('id_ag', $agencyId)
            ->where('in_out', 'In')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->toArray();

        // Create arrays with zeros for all 12 months
        $outOperationsByMonth = array_fill(1, 12, 0);
        $inOperationsByMonth = array_fill(1, 12, 0);

        // Update the arrays with the totals for each month
        foreach ($outOperations as $operation) {
            $outOperationsByMonth[$operation['month']] = (float)$operation['total'];
        }

        foreach ($inOperations as $operation) {
            $inOperationsByMonth[$operation['month']] = (float)$operation['total'];
        }

        return response()->json(['outOperations' => $outOperationsByMonth,
         'inOperations' => $inOperationsByMonth,
         'maxTotal' => $maxTotal]);

        
    }


    public function getOpByInOut(Request $request){


        if ($request->in_out == "") {
            $op_total = Operation::where("deleted_at", null)->where('date', date('Y-m-d'))->sum('montant');
            $op_total += Operation::where("deleted_at", null)->where('date', date('Y-m-d'))->sum('cost');
        }else{
            $op_total = Operation::where("deleted_at", null)->where('date', date('Y-m-d'))->where('in_out', $request->in_out)->sum('montant');
            $op_total += Operation::where("deleted_at", null)->where('date', date('Y-m-d'))->sum('cost');
        }

        
        if ($op_total !="") {
            return response()->json($op_total);
        }
    }

    public function export(){
        
        $user_id = 1;
        $ag_id = 1;
        $type = 'Out';
        $selected_date = now();

        $caisse = CaisseDetail::where('date', now())->where('deleted_at',null)->first();

        $grouped_operations = DB::table('operations')
        ->select(
            'produits.name',
            'in_out',
            DB::raw('SUM(montant + cost) as total'),
            DB::raw('COUNT(*) as count')
        )
        ->join('produits', 'produits.id', '=', 'operations.id_prod')
        ->where('operations.id_user', $user_id)
        ->whereDate('operations.date', $selected_date)
        ->where('operations.id_ag', $ag_id)
        ->groupBy('produits.name', 'in_out')
        ->get();

        $sum_total = 0.00;
        $sum_count = 0.00;

        foreach ($grouped_operations as $operation) {
            $sum_total += $operation->total;
            $sum_count += $operation->count;
        }


        // Get all charges by id_user and id_ag
        $charges = Charge::where('id_user', $user_id)
        ->where('id_ag', $ag_id)
        ->with('user')
        ->get();

        $pdf = Pdf::loadView('dash.pv',['charges'=> $charges, 'sum_total'=> $sum_total,'sum_count'=> $sum_count, 'grouped_operations'=>$grouped_operations, 'caisse'=>$caisse,]);
        return $pdf->stream('invoice.pdf');
    }

   
}
