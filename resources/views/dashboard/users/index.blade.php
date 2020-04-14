@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">
    	<table class="table table-hover">
		<thead>
			<th>Image</th>
			<th>Name</th>
			<th>Permissions</th>
			<th>Delete</th>
		</thead>
		<tbody>
			@if($users->count() > 0)
				@foreach($users as $user)
				<tr>
					<td>
					<img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name }}" width="60px" height="60px" style="border-radius: 50%">
					</td>
					<td>{{ $user->name }}</td>
					<td>
					@if($user->admin)
						<a href="{{ route('user.member', ['id' => $user->id]) }}" class="btn btn-outline-success">
							<i class="fas fa-lock-open"></i>
						</a>
					@else
						<a href="{{ route('user.admin', ['id' => $user->id]) }}" class="btn btn-outline-danger">
							<i class="fas fa-lock"></i>
						</a>
					@endif
					</td>
					<td>
					@if(Auth :: id() !== $user->id)
						<a href="{{ route('user.destroy', ['id' => $user->id]) }}" class="btn btn-danger">
							<i class="fas fa-trash-alt"></i>
						</a>
					@endif
					</td>
					<!-- <td>
						<form action="{{-- route('user.destroy', $user) --}}" method="user" class="d-inline">
							{{ @csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
						</form>	
					</td> -->
				</tr>
				@endforeach
			@else
				<tr>
					<th colspan="5" class="text-center">No user yet</th>
				</tr>
			@endif
		</tbody>
	</table>   
    </div>
</div>
@stop


