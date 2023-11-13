<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MealSelection;
use Illuminate\Support\Facades\Auth;

class MealSelectionsMiddleware
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
        if ($request->selected_meal_id) {
            $meal_selection = MealSelection::findOrFail($request->selected_meal_id);
            if ($meal_selection->user_id != Auth::user()->id) {
                return response('Unauthorized.', 401);
            }
        }

        return $next($request);
    }
}
