<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];
        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('manKind')->accessToken,
            ];
            return response()->json($response, $status);
        }
    }
    public function register(Request $request)
    {
        // User Data to validate
        $validator = Validator::make($request->all(), [
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
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->only(['firstname', 'lastname', 'DOB', 'gender', 'phone', 'country', 'state', 'city', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->is_admin = 0;
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('manKind')->accessToken
        ]);
    }
   
}
