<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhumacion extends Model
{
    use HasFactory;


    protected $table = 'exhumaciones'; 

    protected $fillable = [
        'nicho_id',
        'solicitante',
        'motivo',
        'aprobado',
        'nuevo_ocupante_id',
    ];

    // Relación con Nicho
    public function nicho()
    {
        return $this->belongsTo(Nicho::class, 'nicho_id');
    }

    // Relación con el Nuevo Ocupante
    public function nuevoOcupante()
    {
        return $this->belongsTo(User::class, 'nuevo_ocupante_id');
    }
}
