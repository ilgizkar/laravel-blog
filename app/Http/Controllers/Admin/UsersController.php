<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'avatar'=>'nullable|image'
        ]);
        $user = User::add($request->all());
        // dd($user);
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('users.index');
    }

   
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'avatar'=>'nullable|image'
        ]);
       
        $user->edit($request->all());
        $user->uploadAvatar($request->file('avatar'));
        $user->generatePassword($request->get('password'));
        return redirect()->route('users.index');
    }

   
    public function destroy($id)
    {
        User::find($id)->remove();
        return redirect()->route('users.index');
    }
}
