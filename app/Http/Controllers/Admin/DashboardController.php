<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function comments()
    {
        $comments = Comment::all();

        return view('admin.comments.comments', ['comments'=> $comments]);
    }

    public function toggle($id)
    {
        $comment = Comment::find($id);

        $comment->toggleStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->remove();

        return redirect()->back();
    }

    
}
