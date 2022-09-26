<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class FacebookController extends Controller
{
    public function login()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {

        try {

            $user = Socialite::driver('facebook')->stateless()->user();
            $saveUser = User::updateOrCreate([
                "facebook_id" => $user->getId(),

            ], [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "password" => Hash::make($user->getName() . '@' . $user->getId())

            ]);

            Auth::loginUsingId($saveUser->id);
            return redirect()->route('home');
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
