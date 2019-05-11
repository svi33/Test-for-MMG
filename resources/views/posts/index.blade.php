@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Posts</div>
                    <a type="button" class="btn btn-default" href="{{ route('posts.create')}}">Add</a>
					<div class="panel-body">
						@if($posts->count() > 0)
							<table class="table">
								<tr>
									<th>id</th>
									<th>name</th>
                                    <th>file(new file name)</th>
									<th>actions</th>
								</tr>
								@foreach($posts as $post)
									<tr>
										<td>{{ $post->id }}</td>
										<td>{{ $post->name }}</td>
                                        <td>{{ $post->file }} </td>
										<td>
											<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
												<a type="button" class="btn btn-default" href="{{ route('posts.edit', $post->id) }}">edit</a>
												{{ method_field('DELETE') }}
												{{ csrf_field() }}
												<button type="submit" class="btn btn-danger">delete</button>
                                                <a type="button" class="btn btn-default" href="{{ route('posts.show', $post->id) }}">show</a>
											</form>
										</td>
									</tr>
								@endforeach
							</table>
						@else
							No posts
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection