<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['vendedor', 'servicios', 'producto', 'cliente'];

    protected $appends = ['direccion_completa'];

    public function getDireccionCompletaAttribute()
    {
        return $this->direccion . ' - ' . $this->distrito->nombre;
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
}
