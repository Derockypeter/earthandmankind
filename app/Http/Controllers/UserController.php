<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['premiums'])->get());
    }
    public function show(User $user)
    {
        return response()->json($user);
    }
}
