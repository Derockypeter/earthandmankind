<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
class SocialController extends Controller{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleProviderCallback(Request $request){
        $userSocial = Socialite::driver('facebook')->stateless()->user(); 
        $findUser = User::where('email', $userSocial->email)->first();

        if ($findUser !== null) {
            $status = 200;
            $response = [
                'user' => $findUser,
                'token' => $findUser->createToken('manKind')->accessToken,
            ];
            return response()->json($response, $status);
        }
        else {
            $name = preg_split('/[\s,]+/', $userSocial->name, 3);
          
            $user = new User();

            $user->firstname = $name[0];
            $user->lastname = $name[1];
            $user->email = $userSocial->getEmail();

            $user->save();
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('manKind')->accessToken
            ]);
        }
    }
}