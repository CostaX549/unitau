<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Equipe;
class EquipePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Equipe $equipe): bool
    {
        //
        return $equipe->owner()->is($user);
    }

    public function canCreate(User $user, Equipe $equipe){
          return $user->id===$equipe->owner_id;
    }
}
