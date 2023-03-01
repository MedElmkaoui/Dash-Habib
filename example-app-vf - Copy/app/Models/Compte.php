<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable = ['name', 'n_compte', 'adr', 'tel', 'sold'];

    public function alimentations()
    {
        return $this->hasMany(Alimentation::class, 'id_compte');
    }
}
