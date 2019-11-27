<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Mail\SubscribeMail;
use App\Mail;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|unique:subscriptions'
        ]);

        // dd($request);die;        
        $subs = Subscription::add($request->get('email'), $request->get('_token'));

        \Mail::to($subs)->send(new SubscribeMail($subs));
        // dd($s); die;
        return redirect()->back()->with('status', 'Проверьте вашу почту!');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();

        return redirect('/')->with('status', 'Ваша почта подтверждена!');
    }
}
