<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeCat extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function charges()
    {
        return $this->hasMany(Charge::class, 'id_cat');
    }
}
