<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaisseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'id_caisse',
        'n_200',
        'n_100',
        'n_50',
        'n_20',
        'n_10',
        'n_5',
        'n_2',
        'n_1',
        'n_05',
        'n_04',
        'n_02',
        'sold_total',
    ];

    public function caisse()
    {
        return $this->belongsTo(Caisse::class, 'id_caisse');
    }
}
