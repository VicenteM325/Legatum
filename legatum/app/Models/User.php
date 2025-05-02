<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rol_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
          /**
     * Relación con el modelo Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'rol_id'); 
    }

    /**
     * Verifica si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role->nombre === 'Administrador';
    }

    /**
     * Verifica si el usuario es ayudante
     */
    public function isAssistant(): bool
    {
        return $this->role && $this->role->nombre === 'Ayudante';
    }
    /**
     * Verifica si el usuario es ayudante
     */
    public function isAuditor(): bool
    {
        return $this->role && $this->role->nombre === 'Auditor';
    }
    /**
     * Verifica si el usuario es consultor
     */
    public function isConsultor(): bool
    {
        return $this->role && $this->role->nombre === 'Consultor';
    }

    /**
     * Verifica si el usuario tiene un permiso específico
     */
    public function canAccess(string $permission): bool
    {
        // Verificación segura con carga eager de permisos
        return $this->role && $this->role->permissions
            ->where('nombre', $permission)
            ->isNotEmpty();
    }

    /**
     * Carga siempre la relación role con sus permisos
     */
    protected $with = ['role.permissions'];
}
