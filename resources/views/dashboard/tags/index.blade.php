@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tags</div>
    <div class="card-body">
    	<table class="table table-hover">
		<thead>
			<th>Tags</th>
			<th>Editing</th>
			<th>Deleting</th>
		</thead>
		<tbody>
			@if($tags->count() > 0)
				@foreach($tags as $tag)
				<tr>
					<td>{{ $tag->tag }}</td>
					<td>
						<a href="{{ route('tag.edit', ['id' => $tag->id]) }}" class=" btn btn-outline-info"><i class="fas fa-edit"></i>
						</a>
					</td>
					<td>
						<a href="{{ route('tag.destroy', ['id' => $tag->id]) }}" class=" btn btn-outline-danger"><i class="fas fa-trash-alt"></i>
						</a>
					</td>
					<!-- <td>
						<form action="{{-- route('tag.destroy', $tag) --}}" method="post" class="d-inline">
							{{-- @csrf_field() --}}
							{{-- method_field('DELETE') --}}
							<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
						</form>	
					</td> -->
				</tr>
				@endforeach
			@else
				<tr>
					<th colspan="5" class="text-center">No Tags yet</th>
				</tr>
			@endif
		</tbody>
	</table>    
    </div>
</div>
@stop


