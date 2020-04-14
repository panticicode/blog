@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Published Post</div>
    <div class="card-body">
    	<table class="table table-hover">
		<thead>
			<th>Image</th>
			<th>Title</th>
			<th>Edit</th>
			<th>Trash</th>
		</thead>
		<tbody>
			@if($posts->count() > 0)
				@foreach($posts as $post)
				<tr>
					<td>
						<img src="{{ asset($post->featured) }}" alt="{{ $post->title }}" width="90px" height="50px">
					</td>
					<td>{{ $post->title }}</td>
					<td>
						<a href="{{ route('post.edit', ['id' => $post->id]) }}" class=" btn btn-outline-info"><i class="fas fa-edit"></i>
						</a>
					</td>
					<td>
						<a href="{{ route('post.destroy', ['id' => $post->id]) }}" class=" btn btn-outline-warning"><i class="fas fa-trash-alt"></i>
						</a>
					</td>
					<!-- <td>
						<form action="{{-- route('post.destroy', $post) --}}" method="post" class="d-inline">
							{{ @csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
						</form>	
					</td> -->
				</tr>
				@endforeach
			@else
				<tr>
					<th colspan="5" class="text-center">No post yet</th>
				</tr>
			@endif
		</tbody>
	</table>   
    </div>
</div>
@stop


