<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['tipo_servicio', 'operador'];

    protected $appends = ['estado'];

    public function getEstadoAttribute()
    {
        if ($this->fecha_cierre) {
            return "FINALIZADO";
        }

        if ($this->especialista) {
            return "EN CURSO";
        }

        return "INICIADO";
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function tipo_servicio()
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }

    public function operador()
    {
        return $this->belongsTo(User::class, 'operador_id');
    }
}
