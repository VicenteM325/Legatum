<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nicho extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'tipo', 'calle', 'avenida', 'estado', 'es_historico',
    ];

    // Relación con los Contratos
    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function ocupante()
    {
        return $this->hasOne(Ocupante::class);
    }
}
