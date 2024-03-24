<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class CustomAuthController extends Controller
{
    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'phone'=>'required|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);

        $user = new User([
            'name'  => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
        'phone' => 'required',
        'password' => 'required|string',
        'remember_me' => 'boolean'
        ]);

        $credentials = request(['phone','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'message' => 'Unauthorized'
        ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
        'accessToken' =>$token,
        'token_type' => 'Bearer',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);

    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required'
        ]);
        
        $userId = $request->user()->id;
        $userData['password'] = bcrypt($request->new_password);
        User::where('id', $userId)->update($userData);

        return response()->json([
        'message' => 'Successfully updated password'
        ],200);

    }
}

?>