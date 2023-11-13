<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\SampleDataService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Demos extends Controller
{
    public function login()
    {
        return view('auth/demo_login');
    }

    public function loginAction(Request $request)
    {
        $user = User::factory()->demo()->create();
        if ($request->sample_data) {
            SampleDataService::generate(15, $user);
        }
        Auth::login($user);

        return redirect()->route('selections.calendar')->with('success', 'Welcome, ' . $user->name . '!');
    }

    public function logoutAction(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
