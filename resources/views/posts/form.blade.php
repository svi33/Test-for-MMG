@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					@if(empty($entity))
						<div class="panel-heading">Create new post</div>
					@else
						<div class="panel-heading">Edit post</div>
					@endif
					<div class="panel-body">
						<form action="@if(empty($entity)){{ route('posts.store') }}@else{{ route('posts.update', $entity->id) }}@endif" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							@isset($entity)
								{{ method_field('PUT') }}
							@endisset
							<div >
								@include('fields.text', ['field' => 'name', 'name' => 'name'])
								@include('fields.textarea', ['field' => 'content', 'name' => 'content', 'rows' => 10])
								@include('fields.select', ['field' => 'category_id', 'name' => 'Category', 'options' => $categories])

                                @isset($entity)
                                    @include('fields.image', ['field' => 'file', 'name' => 'file'])
                                    <input type="hidden" name="hidden_file" value="{{ $entity->file }}">
                                @endisset
							</div>
							<input type="submit" value="save">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection