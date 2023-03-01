<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitCat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'in_out'];


    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_cat');
    }
}
