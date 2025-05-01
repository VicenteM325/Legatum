<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupante extends Model
{
    use HasFactory;

    protected $table = 'ocupantes';

    protected $fillable = [
        'nicho_id',
        'responsable_id',
        'nombre',
        'apellidos',
        'dpi',
        'procedencia',
        'fecha_fallecimiento',
        'causa_muerte',
        'genero',
        'fecha_nacimiento',
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'ocupante_id');
    }

    public function nicho()
    {
    return $this->belongsTo(Nicho::class);
    }

    public function responsable()
    {
    return $this->belongsTo(Responsable::class);
    }




}
