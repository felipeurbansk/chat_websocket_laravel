<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = collect(User::all());
        $users = $users->filter(function ($user) {
            return $user->id != Auth::user()->id;
        });

        return response()->json([
            'users' => $users->all()
        ], Response::HTTP_OK);
    }

    public function show(User $user)
    {
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    public function me()
    {
        return response()->json(['user' => Auth::user()], Response::HTTP_OK);
    }
}
