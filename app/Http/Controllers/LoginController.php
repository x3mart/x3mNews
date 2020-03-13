<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginVK()
    {
        session()->get('soc.token');
        if (Auth::id())
        {
           return redirect()->route('home');
        }
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(UserRepository $userRepository)
    {
        if (Auth::id())
        {
            return redirect()->route('home');
        }
        $user = Socialite::driver('vkontakte')->user();
        session(['soc.token' => $user->token]);
        $userInSystem = $userRepository->getUserBySocId($user, 'vk');
        Auth::login($userInSystem);
        return redirect()->route('home');
    }
    public function loginOdnoklassniki ()
    {
        if (Auth::id())
        {
           return redirect()->route('home');
        }
        return Socialite::with('odnoklassniki')->redirect();
    }
    public function responseOdnoklassniki(UserRepository $userRepository) {
        if (Auth::id())
        {
            return redirect()->route('home');
        }
        $user = Socialite::driver('odnoklassniki')->user();
        session(['soc.token' => $user->token]);
        $userInSystem = $userRepository->getUserBySocId($user, 'ok');
        Auth::login($userInSystem);
        return redirect()->route('home');
    }
}
