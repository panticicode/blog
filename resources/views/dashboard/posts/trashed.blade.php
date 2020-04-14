@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Trashed Post</div>
    <div class="card-body">
    	<table class="table table-hover">
		<thead>
			<th>Image</th>
			<th>Title</th>
			<th>Restore</th>
			<th>Delete</th>
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
						<a href="{{ route('post.restore', ['id' => $post->id]) }}" class=" btn btn-outline-success"><i class="fas fa-undo-alt"></i>
						</a>
					</td>
					<td>
						<a href="{{ route('post.deletedFromTrash', ['id' => $post->id]) }}" class=" btn btn-outline-danger"><i class="fas fa-trash-alt"></i>
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
					<th colspan="5" class="text-center">No trashed Post</th>
				</tr>
			@endif
		</tbody>
	</table>   
    </div>
</div>
@stop


