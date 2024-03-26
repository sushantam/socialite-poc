<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
            $data = Socialite::driver('google')->user();
            $userData = [
                "name" => $data->name,
                "email" => $data->email,
                "password" => "password"
            ];
            $user = User::firstOrCreate(
                ['email' => $userData['email']], 
                ['name' => $userData['name'], 'password' => $userData['password']]
            );
            
            Auth::login($user);

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('welcome')->with('error', 'Failed to login with Google.');
     
        }
        
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        $user = Socialite::driver('apple')->user();

        return redirect()->route('home')->with('userData', $user);

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
