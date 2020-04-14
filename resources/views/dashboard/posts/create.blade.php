@extends('layouts.app')

@section('content')

@include('errors.errors')
<div class="card">
    <div class="card-header">Create New Post</div>
    <div class="card-body">
    	<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    		{{ csrf_field() }}
    		<div class="form-group">
    			<label for="title">Title</label>
    			<input class="form-control" type="text" name="title">
    		</div>
    		<div class="form-group">
    			<label for="featured">Featured Image</label>
    			<input class="form-control" type="file" name="featured">
    		</div>
            <div class="form-group">
                <label for="category">Select a Category</label> 
                <select name="category_id" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="form-group">
            <label for="tags">Select tags</label>    
            @foreach($tags as $tag)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->tag }}
                    </label>
                </div>
            @endforeach
            </div>
    		<div class="form-group">
    			<label for="content">Content</label>
    			<textarea name="content" id="content" cols="5" rows="5" class="form-control">
    				
    			</textarea>
    		</div>
    		<div class="form-group">
    			<div class="text-center">
    				<button class="btn btn-success" type="submit">
    					Store Post
    				</button>
    			</div>
    		</div>	
    	</form>   
    </div>
</div>	
@stop

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
  </script>
@stop