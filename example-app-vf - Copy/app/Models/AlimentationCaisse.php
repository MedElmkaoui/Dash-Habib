<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentationCaisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'id_user',
        'id_user_donneur',
        'montant',
        'confirmation',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function donneur()
    {
        return $this->belongsTo(User::class, 'id_user_donneur');
    }
}
