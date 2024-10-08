<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                "username" => $request['username'],
                "password" => Hash::make($request['password']),
            ]);

            DB::commit();
            return [
                "token" => $user->createToken("auth_token")->plainTextToken
            ];
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return $this->errorResponse($throwable->getMessage());
        }
    }
}
