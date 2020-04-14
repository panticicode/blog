@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Create New User</div>
    <div class="card-body">
    	<form action="{{ route('user.store') }}" method="POST">
    		{{ csrf_field() }}
    		<div class="form-group">
    			<label for="user">User</label>
    			<input class="form-control" type="text" name="name">
    		</div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email">
            </div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Create User
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop