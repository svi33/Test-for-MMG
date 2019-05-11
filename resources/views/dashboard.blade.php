@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="jumbotron">
                    <p><span class="label label-primary">Categories: {{$count_categories}}</span></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron">
                    <p><span class="label label-primary">Posts: {{$count_posts}}</span></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron">
                    <p><span class="label label-primary">Comments: {{$count_comments}} </span></p>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <a class="btn btn-block btn-default" href="{{route('category.create')}}">Create category</a>
                @foreach ($categories as $category)
                    <a class="list-group-item" href="{{route('category.show', $category)}}">
                        <h4 class="list-group-item-heading">{{$category->name}}</h4>
                        <p class="list-group-item-text">
                            {{$category->posts()->count()}}
                        </p>
                    </a>
                @endforeach
            </div>
            <div class="col-sm-6">
                <a class="btn btn-block btn-default" href="posts.create">Create post</a>
                @foreach ($posts as $post)
                    <a class="list-group-item" href="#{{  route('posts.show', $post) }}">
                        <h4 class="list-group-item-heading">{{$post->name}}</h4>
                        <p class="list-group-item-text">
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection