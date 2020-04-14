@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Edit Category: {{ $category->name }}</div>
    <div class="card-body">
    	<form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
    		{{ csrf_field() }}
            {{-- method_field('PUT') --}}
    		<div class="form-group">
    			<label for="name">Name</label>
    			<input class="form-control" type="text" value="{{ $category->name }}" name="name">
    		</div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Update Category
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop