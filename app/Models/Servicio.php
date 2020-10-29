<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['tipoServicio', 'operador'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }

    public function operador()
    {
        return $this->belongsTo(User::class, 'operador_id');
    }
}
