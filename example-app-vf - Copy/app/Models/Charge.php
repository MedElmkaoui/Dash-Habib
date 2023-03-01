<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'id_ag',
        'date',
        'id_cat',
        'montant',
        'id_user',
        'note'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'id_ag');
    }

    public function category()
    {
        return $this->belongsTo(ChargeCat::class, 'id_cat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
