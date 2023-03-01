<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_prod',
        'id_cat',
        'date',
        'montant',
        'cost',
        'in_out',
        'id_ag',
        'note',
        'id_user',
    ];

    public function operationcats()
    {
        return $this->belongsTo(OperationCat::class, 'id_cat');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_prod');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'id_ag');
    }

}
