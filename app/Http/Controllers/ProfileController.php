<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile', ['user'=>$user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'avatar'=>'nullable'
        ]);

        
        $user = Auth::user();
        $user->edit($request->all());
        // dd($request->file('avatar'));
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->back()->with('status', 'Профиль успешно изменен');
    }
}
