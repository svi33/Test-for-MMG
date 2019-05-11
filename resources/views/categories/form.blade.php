@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    @if(empty($entity))
                        <div class="panel-heading">Create new category</div>
                    @else
                        <div class="panel-heading">Edit category</div>
                    @endif
                    <div class="panel-body">
                        <form action="@if(empty($entity)){{ route('category.store') }}@else{{ route('category.update', $entity->id) }}@endif" method="POST">
                            {{ csrf_field() }}
                            @isset($entity)
                                {{ method_field('PUT') }}
                            @endisset
                            <div >
                                @include('fields.text', ['field' => 'name', 'name' => 'name'])
                                @include('fields.text', ['field' => 'description', 'name' => 'description '])
                            </div>
                            <input type="submit" value="save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection