<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        if($request->isMethod('post'))
        {
            $user = Auth::user();
            $this->validate($request, $this->ValidateRules($request),[],$this->attributeNames());
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
            return redirect()->route('admin.updateProfile')->withErrors($errors);
        }

        return view('admin.profile');
    }

    public function ValidateRules ($request)
    {
        return
            [
                'name' => 'required|string|max:10',
                'email' => 'required|email|unique:users,email,'.Auth::id(),
                'curent_password' => 'required|string',
                'password' => $request->password ? 'string|min:3' : '',
                'password_confirm' => ($request->password_confirm || $request->password) ? 'same:password|string' :''
            ];
    }

    protected function attributeNames()
    {
        return
        [
            'curent_password' => 'Пароль',
            'password' => 'Новый пароль',
            'password_confirm' =>'Пароль еще разок'
        ];
    }
}
