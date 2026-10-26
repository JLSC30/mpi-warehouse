<?php

namespace App\Policies;

use App\Models\User;

trait AdminPolicyTrait
{
    public function before(User $user): ?bool
    {
        return $user->is_admin ? true : null;
    }
}
