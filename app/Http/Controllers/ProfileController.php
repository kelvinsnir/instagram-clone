<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function index(User $user)
    {   
    	// $user = User::findOrFail($user);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), 
                        function () use ($user){
                            return $user->posts->count();
                        });
    
        $followersCount = Cache::remember('count.followers.' . $user->id, now()->addSeconds(30), 
                                function () use ($user){
                                    return $user->profile->followers->count();
                                });
        $followingCount = Cache::remember('count.following.' . $user->id, now()->addSeconds(30), 
                                function () use ($user){
                                    return  $user->following->count();
                                });

    	return view('profiles.index', ['user' => $user, 'follows' => $follows, 'postCount' => $postCount, 'followersCount' => $followersCount, 'followingCount' => $followingCount]);
    	// return view('home')->with('user', $user);
    }

    public function edit(User $user)
    { 
      $this->authorize('update', $user->profile);

      return view('profiles.edit', ['user'=>$user]);
    }

    public function update(User $user)
    {   
    	$this->authorize('update', $user->profile);

    	$data = request()->validate([
    		'title' => 'required',
    		'description'=> 'required',
    		'url'=> 'url',
    		'image'=>'',
    	]);
        
        
    	if(request('image')){
	    	$imagepath = request('image')->store('profile', 'public');

	    	$image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
	    	$image->save();

            $imageArray = ['image' => $imagepath];
    	}
    	

    	auth()->user()->profile->update(array_merge($data, $imageArray ?? [] ));

    	return redirect("/profile/{$user->id}");
    }
}
