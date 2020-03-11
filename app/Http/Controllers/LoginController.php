<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function loginVK() {
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK() {
        $user = Socialite::driver('vkontakte')->user();
        dd($user);
    }
}
