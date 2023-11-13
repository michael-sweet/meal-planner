<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealsMiddleware
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
        if ($request->meal_id) {
            $meal = Meal::findOrFail($request->meal_id);
            if ($meal->user_id != Auth::user()->id) {
                return response('Unauthorized.', 401);
            }
        }

        return $next($request);
    }
}
