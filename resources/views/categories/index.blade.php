@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">
                        <a type="button" class="btn btn-default" href="{{ route('category.create')}}">Add</a>
                        @if($categories->count() > 0)
                            <table class="table">
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name}}</td>
                                        <td>{{ $category->description}}</td>
                                        <td>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                <a type="button" class="btn btn-default" href="{{ route('category.edit', $category->id) }}">edit</a>
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">delete</button>
                                                <a type="button" class="btn btn-default" href="{{ route('category.show', $category->id) }}">show</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            empty... add new?
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection