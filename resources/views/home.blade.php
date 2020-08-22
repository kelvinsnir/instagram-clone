@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-3">
           <img src="/instalogo/inslogo.png" class="border-circle">
       </div>
       <div class="col-9">
           <div class="d-flex justify-content-between align-items-baseline">
            <h1>{{$user->username}}</h1>
            <a href="#">Add New Post</a>
          </div>
           <div class="d-flex">
               <div class="pr-3"><strong>255</strong> posts</div>
               <div class="pr-3"><strong>10k</strong> followers</div>
               <div class="pr-3"><strong>200</strong> following</div>
           </div>
           <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
           <div>{{$user->profile->description}}</div>
           <div><a href="#"><b>{{$user->profile->url}}</b></a></div>
       </div>
   </div>
   <div class="row pt-4">
       <div class="col-4"><img src="/instalogo/image3.jpg" class="w-100"></div>
       <div class="col-4"><img src="/instalogo/image3.jpg" class="w-100"></div>
       <div class="col-4"><img src="/instalogo/image3.jpg"class="w-100"></div>
   </div>
</div>
@endsection
