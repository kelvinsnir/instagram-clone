@extends('layouts.app')

@section('content')
<div class="container">
  
  	<form action="/p" enctype="multipart/form-data" method="post">
  		@csrf
  		<div class="row">
  		<div class="col-8 offset-2">	

  			<div class="row">
  				<h1>Add New Post</h1>
  			</div>
	  		<div class="form-group row">
	            <label for="caption" class="col-md-4 col-form-label">post caption</label>
	                <input id="name" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('name') }}"  autocomplete="name" autofocus>
	                
	                @error('caption')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	            
	        </div>

		    <div class="row">
	  	   	<label for="images" class="col-md-4 col-form-label">post image</label>
	  	   	 <input type="file" name="images" id="images" class="form-control-file  @error('images') is-invalid @enderror">
	  	   	  @error('images')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror
	  	   </div>
           <div class="row pt-3">
           	  <button class="btn btn-primary">A New Post</button>
           </div>

  	   </div>
  	   </div>
  	</form>

</div>
@endsection
