<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $with = ['tipo_documento_identidad'];

    protected $appends = ['nombre_completo'];

    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' '
            . $this->ape_paterno . ' '
            . $this->ape_materno;
    }

    public function compras()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function tipo_documento_identidad()
    {
        return $this->belongsTo(TipoDocumentoIdentidad::class, 'tipo_documento_id');
    }

}
