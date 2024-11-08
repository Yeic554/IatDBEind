<?php

namespace App\Policies;

use App\User;
use App\Lending;

class LendingPolicy
{
    /**
     * Determine whether the user can view the lending.
     *
     * @param  \App\User  $user
     * @param  \App\Lending  $lending
     * @return bool
     */
    public function view(User $user, Lending $lending)
    {
        return $user->id === $lending->borrower_id || $user->id === $lending->lender_id;
    }
}

