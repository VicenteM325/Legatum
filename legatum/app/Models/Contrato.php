<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nicho_id',
        'ocupante_id',
        'responsable_id',
        'monto',
        'fecha_inicio',
        'fecha_fin',
        'gracia',
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function nicho()
    {
        return $this->belongsTo(Nicho::class);
    }

    public function ocupante()
    {
    return $this->belongsTo(Ocupante::class);
    }   

    public function responsable()
    {
    return $this->belongsTo(Responsable::class);
    }
}
