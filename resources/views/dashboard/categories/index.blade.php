@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Categories</div>
    <div class="card-body">
    	<table class="table table-hover">
		<thead>
			<th>Category Name</th>
			<th>Editing</th>
			<th>Deleting</th>
		</thead>
		<tbody>
			@if($categories->count() > 0)
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->name }}</td>
					<td>
						<a href="{{ route('category.edit', ['id' => $category->id]) }}" class=" btn btn-outline-info"><i class="fas fa-edit"></i>
						</a>
					</td>
					<td>
						<a href="{{ route('category.destroy', ['id' => $category->id]) }}" class=" btn btn-outline-danger"><i class="fas fa-trash-alt"></i>
						</a>
					</td>
					<!-- <td>
						<form action="{{ route('category.destroy', $category) }}" method="post" class="d-inline">
							{{ @csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
						</form>	
					</td> -->
				</tr>
				@endforeach
			@else
				<tr>
					<th colspan="5" class="text-center">No Categories yet</th>
				</tr>
			@endif
		</tbody>
	</table>    
    </div>
</div>
@stop


