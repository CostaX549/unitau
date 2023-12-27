<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tarefa;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,Tarefa $tarefa){
          return $user->id === $tarefa->owner_id;
    }

    public function enviar(User $user,Tarefa $tarefa){
          return now()< $tarefa->EndDate;
            
          
    }
}
