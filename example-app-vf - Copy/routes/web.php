<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::resource('/produit-cats', 'App\Http\Controllers\ProduitCatController');

Route::resource('/produits', 'App\Http\Controllers\ProduitController');

Route::resource('/comptes', 'App\Http\Controllers\CompteController');

Route::resource('/operation-cats', 'App\Http\Controllers\OperationCatController');

Route::resource('/operations', 'App\Http\Controllers\OperationController');

Route::resource('/agencies', 'App\Http\Controllers\AgencyController');

Route::resource('/users', 'App\Http\Controllers\UserController');


Route::resource('/caisses', 'App\Http\Controllers\CaisseController');

Route::resource('/chargeCats', 'App\Http\Controllers\ChargeCatController');

Route::resource('/charges', 'App\Http\Controllers\ChargeController');

Route::resource('/alimentations', 'App\Http\Controllers\AlimentationController');

Route::resource('/caisse-details', 'App\Http\Controllers\CaisseDetailController');

Route::resource('/alimentations_caisse', 'App\Http\Controllers\AlimentationCaisseController');

Route::get('/', [DashController::class, 'index'])->name('dash');

Route::get('get-benefits/', [DashController::class, 'getBenefitsByAgency'])->name('benefits');
Route::get('get-charges/', [DashController::class, 'getchargesByAgency'])->name('charges');
Route::get('get-comptes/', [DashController::class, 'getSoldByCompte'])->name('comptes-sold');
Route::get('get-op/', [DashController::class, 'getOpByInOut'])->name('op_in_out');
Route::get('get-data-graph/', [DashController::class, 'getDataForGraph'])->name('getDateForGraph');
Route::get('export/', [DashController::class, 'export'])->name('export');



Route::get('get-cats', [OperationController::class, 'getCategories'])->name('get-cats');
Route::get('get-prods', [OperationController::class, 'getProduits'])->name('get-prods');






