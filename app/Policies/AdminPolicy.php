<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Determine if the user is an admin
     */
    public function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }
}
