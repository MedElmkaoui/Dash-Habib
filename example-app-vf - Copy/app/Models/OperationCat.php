<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationCat extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function operations()
    {
        return $this->hasMany(Operation::class, 'id_cat');
    }
}
