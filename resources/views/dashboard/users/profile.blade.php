@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Edit your Profile</div>
    <div class="card-body">
    	<form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="name">Name</label>
			<input class="form-control" type="text" name="name" value="{{ $user->name }}">
		</div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" 
            value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="avatar">Upload new Avatar</label>
            <input class="form-control" type="file" name="avatar">
        </div>
        <div class="form-group">
            <label for="facebook">Facebook profile</label>
            <input class="form-control" type="text" name="facebook"
            value="{{ $user->profile->facebook }}">
        </div>
         <div class="form-group">
            <label for="youtube">Youtube profile</label>
            <input class="form-control" type="text" name="youtube"
            value="{{ $user->profile->youtube }}">
        </div>
        <div class="form-group">
            <label for="about">About you</label>
            <textarea name="about" id="about" cols="6" rows="6" class="form-control">
                {{ $user->profile->about }}   
            </textarea>
        </div>
		<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">
					Update User
				</button>
			</div>
		</div>	
    	</form>   
    </div>
</div>	
@stop