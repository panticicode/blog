@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Edit Blog Settings</div>
    <div class="card-body">
    	<form action="{{ route('setting.update') }}" method="POST">
    		{{ csrf_field() }}
    		<div class="form-group">
    			<label for="site_name">Site Name</label>
    			<input class="form-control" type="text" name="site_name" value="{{ $settings->site_name }}">
    		</div>
            <div class="form-group">
                <label for="contact_number">Contact Phone</label>
                <input class="form-control" type="text" name="contact_number" value="{{ $settings->contact_number }}">
            </div>
            <div class="form-group">
                <label for="contact_email">Contact Email</label>
                <input class="form-control" type="email" name="contact_email" value="{{ $settings->contact_email }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" name="address" value="{{ $settings->address }}">
            </div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Update Site Settings
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop