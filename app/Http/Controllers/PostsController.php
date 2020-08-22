<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{  
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(1);
        //where user_id is in the list of $users
        // dd($users);
        return view('posts.index', ['posts'=> $posts]);
    }
    //
    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {   
    	$data = request()->validate([
    		'caption'=>'required',
    		'images'=>['required', 'image'],
    	]);

    	$imagepath = request('images')->store('uploads', 'public');

    	$image = Image::make(public_path("storage/{$imagepath}"))->fit(1200, 1200);
    	$image->save();
      
        auth()->user()->posts()->create([
        	'caption'=>$data['caption'],
        	'images'=>$imagepath,
        ]);

    	return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
    	return  view('posts.show', ['post' => $post]);
    	
    }
}
