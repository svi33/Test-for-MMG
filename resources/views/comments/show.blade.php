@extends('layouts/app')

@section('content')

<div class="container">

    <div class="panel panel-default">

        <div class="panel-heading">

            <h3 class="panel-title">{{ $comment->author }}</h3>

        </div>

        <div class="panel-body">

            {{ $comment->content }}

        </div>

    </div>

</div>

@endsection