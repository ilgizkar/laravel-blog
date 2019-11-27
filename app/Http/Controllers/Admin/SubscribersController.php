<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Subscription::all();
        return view('admin.subs.index', ['subs'=>$subs]);
    }

    
    public function create()
    {
        return view('admin.subs.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|unique:subscriptions'
        ]);

        Subscription::addNotToken($request->get('email'));

        return redirect()->route('subscribers.index');
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        $subs = Subscription::find($id);
        $subs->remove();

        return redirect()->back();
    }
}
