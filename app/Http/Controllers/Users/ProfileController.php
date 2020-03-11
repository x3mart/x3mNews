<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        if($request->isMethod('post'))
        {
            $user = Auth::user();
            // $this->validate($request, $this->ValidateRules($request),[],$this->attributeNames());
            if(Hash::check($request->post('curent_password'), $user->password))
            {
                $user->fill(
                    [
                        'name' => $request->post('name'),
                        'email' => $request->post('email'),
                        'password' => $request->password ? Hash::make($request->post('password')) : $user->password
                    ]
                    );
                $user->save();
                $request->session()->flash('success', 'Данные успешно измененны');
                $errors = [];
            } else
            {
                $errors['curent_password'][] = 'Неверно введен текущий пароль';
                $request->flash();
            }
            return redirect()->route('user.updateProfile')->withErrors($errors);
        }

        return view('user.profile');
    }
}

