<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Relación muchos-a-muchos con el modelo Permission.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission', 
            'role_id',       
            'permission_id' 
        );
    }

    /**
     * Relación uno-a-muchos con el modelo User.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'rol_id'); 
    }

    /**
     * Verifica si el rol tiene un permiso específico.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions->contains('nombre', $permission);
    }
}