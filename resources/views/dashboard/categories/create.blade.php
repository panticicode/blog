@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Create New Category</div>
    <div class="card-body">
    	<form action="{{ route('category.store') }}" method="POST">
    		{{ csrf_field() }}
    		<div class="form-group">
    			<label for="name">Name</label>
    			<input class="form-control" type="text" name="name">
    		</div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Store Category
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop