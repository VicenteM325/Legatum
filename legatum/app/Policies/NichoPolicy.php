<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Nicho;

class NichoPolicy
{
    public function viewAny(User $user)
    {
        return true; 
    }

    public function view(User $user, Nicho $nicho)
    {
        return true; 
    }

    public function create(User $user)
    {
        return $user->role === 'Administrador';
    }

    public function update(User $user, Nicho $nicho)
    {
        return $user->role === 'Administrador';
    }

    public function delete(User $user, Nicho $nicho)
    {
        return $user->role === 'Administrador';
    }

    public function viewReport(User $user)
    {
        return in_array($user->role, ['Administrador', 'Ayudante']);
    }
}