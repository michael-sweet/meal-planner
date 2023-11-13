<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredientsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->ingredient_id) {
            $ingredient = Ingredient::findOrFail($request->ingredient_id);
            if ($ingredient->user_id != Auth::user()->id) {
                return response('Unauthorized.', 401);
            }
        }

        return $next($request);
    }
}
