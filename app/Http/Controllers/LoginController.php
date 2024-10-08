<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials =  $request->validate([
            'username' => ['required', 'string', 'exists:users,username'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $request['username'])->first();
        if (Auth::attempt($credentials) && $user) {
            // jika user ada dan sudah login maka delete token yang lama
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token' => $token
            ], 200);
        }

        // jika user tidak ada
        return response()->json([
            'message' => 'Email atau password salah'
        ], 400);
    }
}
