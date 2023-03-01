<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimentation extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'note', 'montant', 'id_user', 'id_compte'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'id_compte');
    }
}
