<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function show(User $user)
    {
        return response()->json($user);
    }
    public function delete($id)
    {
        $userToDelete = User::whereId($id)->firstOrFail();
        $userToDelete->delete();
        return response()->json(null, 204);
    }
}
