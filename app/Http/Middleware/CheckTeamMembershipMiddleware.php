<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipe;
use App\Models\Tarefa;

class CheckTeamMembershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $teamId = $request->route('id'); 

        $equipe = Equipe::find($teamId);

        if($request->route('id1')) {
            $tarefa = Tarefa::find($request->route('id1'));
            if($tarefa) {
            $equipeIdDaTarefa = $tarefa->equipe_id;
            } else {
                abort(404);
            }
         
            if ($equipeIdDaTarefa != $teamId) {
             
                return redirect()->route('equipe.tarefa', ['id' => $equipeIdDaTarefa, 'id1' => $request->route('id1')]);
            }
         }

        if($equipe) {
        if (!$equipe->users()->where('user_id', Auth::id())->exists()) {
          
            abort(403, 'Acesso negado. Você não pertence a esta equipe.');
        }
    }
      
        return $next($request);
    }
}
