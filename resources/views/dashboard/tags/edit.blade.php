@extends('layouts.app')

@section('content')
@include('errors.errors')
<div class="card">
    <div class="card-header">Edit Tag: {{ $tag->tag}}</div>
    <div class="card-body">
    	<form action="{{ route('tag.update', ['id' => $tag->id]) }}" method="POST">
    		{{ csrf_field() }}
            {{-- method_field('PUT') --}}
    		<div class="form-group">
    			<label for="name">Name</label>
    			<input class="form-control" type="text" value="{{ $tag->tag }}" name="tag">
    		</div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Update Tag
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop