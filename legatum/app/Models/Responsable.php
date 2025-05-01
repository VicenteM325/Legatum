<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $table = 'responsables';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dpi',
        'direccion',
        'telefono',
        'email',
    ];


    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'responsable_id');
    }

    public function ocupantes()
    {
    return $this->hasMany(Ocupante::class);
    }

}
