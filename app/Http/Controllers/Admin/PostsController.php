<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=> $posts]);
    }

    
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create', compact(
            'categories',
            'tags'
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'content'=>'required',
            'date'=>'required',
            'image'=>'nullable|image'
        ]);

        
        $post = Post::add($request->all());
        // dd($post);
        // dd($request);
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

   
    public function edit($id)
    {
        $post = Post::find($id);
        // dd($post);
        $categories = Category::pluck('title', 'id')->all();
        
        $tags = Tag::pluck('title', 'id')->all();
        // dd($tags); die;
        return view('admin.posts.edit', compact(
            'categories',
            'tags',
            'post'
        ));
        
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'content'=>'required',
            'date'=>'required',
            'image'=>'nullable|image'
        ]);

        
        $post = Post::find($id);
        // dd($post);
        // dd($request);
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    
    public function destroy($id)
    {
        Post::find($id)->remove();
        return redirect()->route('posts.index');
    }
}
