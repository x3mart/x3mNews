<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function update(Request $request)
    {
        if($request->isMethod('post'))
        {
        $arr = collect($request->except('_token'))->keys()->toArray();
        $checked = User::whereIn('id', $arr)->get();
        $was_checked = User::where('is_admin', 1)->get();
        $not_checked = $was_checked->diff($checked);
        User::whereIn('id', $arr)->update(['is_admin' => 1]);
        User::whereIn('id', $not_checked)->update(['is_admin' => 0]);
        $request->session()->flash('success', 'Админы успешно переназначенны');
        }

        $users = User::all();
        return view('admin.usersUpdate',['users' => $users]);
    }
}
