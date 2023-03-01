<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    
    protected $fillable = ['code_ag', 'adr', 'fix', 'id_user', 'sold_d'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function caisses()
    {
        return $this->hasMany(Caisse::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
