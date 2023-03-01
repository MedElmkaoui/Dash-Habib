<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_caisse',
        'id_user',
        'id_ag',
        'sold_d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'id_ag');
    }

}
