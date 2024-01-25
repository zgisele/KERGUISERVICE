<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CompteActifMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->statut !== 'activer') {

            return response()->json(['message' => 'Compte désactivé'], 403);
        }

        // Si l'utilisateur n'est pas actif, redirigez-le vers la page d'accueil ou renvoyez une réponse appropriée
       

        return $next($request);
    }
}
