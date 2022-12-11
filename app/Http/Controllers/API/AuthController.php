<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name'     => 'required',
            'email'    => 'unique:users|required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::create(['name'  => $request->name,
                              'email' => $request->email, 'password' => bcrypt($request->password)]);
        $user->roles()->attach(2);

        return response()->json($user);
    }
}
