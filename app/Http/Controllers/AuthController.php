<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // User Data to validate
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'DOB' => 'nullable|date' ,
            'gender' => 'nullable',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'email|required:unique:users',
            'password' => 'required|confirmed'
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'accessToken' => $accessToken]);
    }

    public function login(Request $request)
    {
        $dataToCheck = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
            if(!auth()->attempt($dataToCheck)){
                return response(['message' => 'Invalid credentials']);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['user' => auth()->user(), 'accessToken' => $accessToken]);
    }
}
