<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class PersonalAccessTokensController extends Controller
{
    public function store()
    {
        $token = auth()->user()->createToken('all:all');
        return response()->json(['token' => $token->plainTextToken]);
    }

    public function index()
    {
        $tokens = auth()->user()->tokens;
        return response()->json($tokens);
    }
}
