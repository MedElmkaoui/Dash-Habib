<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['name', 'id_cat', 'id_compte'];

    public function produitCat()
    {
        return $this->belongsTo(ProduitCat::class, 'id_cat');
    }

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'id_compte');
    }
}
