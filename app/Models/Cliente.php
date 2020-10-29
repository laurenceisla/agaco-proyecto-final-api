<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function compras()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }
}
