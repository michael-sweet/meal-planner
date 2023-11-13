<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        view()->share('breadcrumbs', [
            ['title' => $user->name],
            ['title' => 'Edit profile']
        ]);
        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function editAction(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please enter a name'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect('/')->with('success', 'User saved!');
    }
}
