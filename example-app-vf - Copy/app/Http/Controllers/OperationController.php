<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\OperationCat;
use App\Models\Produit;
use App\Models\Caisse;
use App\Models\Agency;
use App\Models\Compte;
use App\Models\ProduitCat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OperationController extends Controller
{

    public function index(Request $request)
    {
        $bool = false;
        $operations = Operation::query();
        $users = User::where("deleted_at", null)->get();
        $categories = OperationCat::where("deleted_at", null)->get();

        // Filter by id_prod
        if ($request->id_prod!='') {
            $bool = true;
            $operations->where('id_prod', $request->input('id_prod'));
        }

        // Filter by id_cat
        if ($request->id_cat!='') {
             $bool = true;
            $operations->where('id_cat', $request->input('id_cat'));
        }

        // Filter by date
        if ($request->date!='') {
             $bool = true;
            $operations->where('date', $request->input('date'));
        }

        // Filter by montant
        if ($request->montant!='') {
             $bool = true;
            $operations->where('montant',$request->input('montant'));
        }

        // Filter by cost
        if ($request->cost!='') {
             $bool = true;
            $operations->where('cost', $request->input('cost'));
        }

        // Filter by in_out
        if ($request->in_out!='') {
             $bool = true;
            $operations->where('in_out', $request->input('in_out'));
        }

        // Filter by id_user
        if ($request->id_user!='') {
             $bool = true;
            $operations->where('id_user', $request->input('id_user'));
        }


        if ($bool) {
            $operations = $operations->where("deleted_at", null)->latest()->paginate(5);
            if (Auth::user()->type != 'Admin') {
                $operations = $operations->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }
            return view('operations.index', [ 'categories'=> $categories, 'operations'=> $operations, 'users' => $users ]);
        }else{
            
            if (Auth::user()->type != 'Admin') {
                $operations = $operations->where("id_user",Auth::user()->id)->where("deleted_at", null)->latest()->paginate(5);
            }else{
                $operations = Operation::where("deleted_at", null)->latest()->paginate(5);
            }
            return view('operations.index', [ 'categories'=> $categories, 'operations'=> $operations, 'users' => $users ]);
        }

    }

    public function create()
    {
        $users= User::where('deleted_at', '=', null)->get();
        $categories = OperationCat::where('deleted_at', '=', null)->get();
        $produits = Produit::where('deleted_at', '=', null)->get();
        $produits_cats = ProduitCat::where('deleted_at', '=', null)->get();
        return view('operations.create', ['categories'=> $categories, 'produits'=>$produits, 'produits_cats'=>$produits_cats, 'users'=>$users]);
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'id_prod' => ['required', 'exists:produits,id'],
            'note' => ['nullable'],
            'id_cat' => ['required', 'exists:operation_cats,id'],
            'montant' => ['required', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'in_out' => ['required', 'string', 'in:In,Out'],
        ]);


        if(Auth::user()->type == "User"){
            $caisse = Caisse::find(Auth::user()->id);
        }else{
            $caisse = Caisse::where('id_user',$request->id_user)->first();
        }
        

        $compte = Compte::find(Produit::find($request->id_prod)->id_compte);

        if($caisse != null ){
            if($request->in_out =="Out"){
                if($caisse->sold_d <= 0  ){
                    return redirect()->back()->with('Error','Sold de Votre Caisse est egal à 0.00 (Alimentez votre Caisse SVP)');
                }else{
                    if( ($caisse->sold_d -($request->montant + $request->cost)) < 0){
                        return redirect()->back()->with('Error',"Le montant de cette Operation n'pas disponeble dans votre Caisse ");
                    }
                }
            }
            
        }else{
            return redirect()->back()->with('Error',"Erreur: Vous n'avez pas encore créé de caisse.");
        }

        $operation = new Operation;
        $operation->id_prod = $request->id_prod;
        $operation->id_cat = $request->id_cat;
        $operation->date = $request->date;
        if ($request->date == '') {
            $operation->date = now();
        }
        $operation->montant = $request->montant;
        if ($request->cost == '') {
            $request->cost = 0.00;
        }
        $operation->cost = $request->cost;
        $operation->in_out = $request->in_out;
        $operation->note = $request->note;
        $operation->id_user = $request->id_user;
        if ($request->id_user == '') {
            $request->id_user = Auth::user()->id;
            $operation->id_ag = Auth::user()->caisse->agency->id;
        }else{
            $operation->id_ag = Agency::where('id_user',$request->id_user)->first()->id;
        }

        $agency = Agency::find($operation->id_ag);
        $operation->save();

        
        if ($request->in_out == 'Out' && $caisse != null) {
            $caisse->sold_d -= ($request->montant + $request->cost);
            $agency->sold_d -= ($request->montant + $request->cost);
        }else{
            $caisse->sold_d += ($request->montant + $request->cost);
            $agency->sold_d += ($request->montant + $request->cost);
        }
        if ($request->in_out == 'Out' && $compte != null) {
            $compte->sold += ($request->montant + $request->cost);
        }else{
            $compte->sold -= ($request->montant + $request->cost);
        }

        

        
        $agency->sold_d += $request->sold_d;
        $agency->update();

        $caisse->update();
        $compte->update();
        


        return redirect()->route('operations.index')->with('success', 'Operation created successfully!');
    }

   /* public function edit(Operation $operation)
    {
        $categories = OperationCat::all();
        $produits = Produit::all();
        $produits_cats = ProduitCat::all();
        return view('operations.edit', [ 'categories'=> $categories, 'produits'=>$produits, 'produits_cats'=>$produits_cats, 'operation'=> $operation ]);
    }

    public function show(Request $request, $id)
    {
        $operation = Operation::findOrFail($id);

        $request->validate([
            'id_prod' => ['required', 'exists:produits,id'],
            'note' => ['nullable'],
            'id_cat' => ['required', 'exists:operation_cats,id'],
            'date' => ['required', 'date'],
            'montant' => ['required', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'in_out' => ['required', 'string', 'in:In,Out'],
        ]);

        $operation->id_prod = $request->id_prod;
        $operation->id_cat = $request->id_cat;
        $operation->date = $request->date;
        if ($request->date == '') {
            $operation->date = now();
        }
        $operation->montant = $request->montant;
        $operation->cost = $request->cost;
        if ($request->cost == '') {
            $operation->cost = 0.00;
        }
        $operation->in_out = $request->in_out;
        $operation->note = $request->note;
        $operation->id_user = Auth::user()->id;
        $operation->id_ag = Auth::user()->caisse->agency->id;

        $operation->update();

        return redirect()->route('operations.index')->with('success', 'Operation updated successfully!');
    }*/

    public function update(Request $request, $id)
    {
        
    }

    public function destroy(Operation $operation)
    {
        $caisse = Caisse::find(Auth::user()->id);
        $compte = Compte::find(Produit::find($operation->id_prod)->id_compte);

        if ($operation->in_out == 'Out' && $caisse != null) {
            $caisse->sold_d += ($operation->montant + $operation->cost);
        }else{
            $caisse->sold_d -= ($operation->montant + $operation->cost);
        }
        if ($operation->in_out == 'Out' && $compte != null) {
            $compte->sold -= ($operation->montant + $operation->cost);
        }else{
            $compte->sold += ($operation->montant + $operation->cost);
        }

        $caisse->update();
        $compte->update();


        $operation->deleted_at = now();
        $operation->save();
        return redirect()->route('operations.index')->with('success', 'Operation deleted successfully!');
    }


    public function getProduits(Request $request)
    {
        $prods = Produit::where('id_cat', $request->id_cat)->where('deleted_at', null)->get();
        
        if (count($prods) > 0) {
            return response()->json($prods);
        }
        
    }
    public function getCategories(Request $request)
    {
        $prodCats = ProduitCat::where('in_out', $request->in_out)->where('deleted_at', null)->get();
        
        if (count($prodCats) > 0) {
            return response()->json($prodCats);
        }
        
    }

    public function filtreOp(Request $request){

        $categories = OperationCat::where('deleted_at', null)->get();
        $operations = Operation::where('deleted_at', null)->get();

        if($request->has('id_cat')){
            $operations = Operation::where('slug','like','%'.$request->date.$request->in_out.$request->id_cat.'%')->get();
        }
        
        

        return view('operations.index',  [ 'categories'=> $categories, 'operations'=> $operations ]);
    }

}
