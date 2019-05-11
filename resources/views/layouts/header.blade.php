<nav class="navbar navbar-default navbar-static-top">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <ul class="nav navbar-nav navbar-toggler">
            <a href="{{ route('category.index') }}"> Categories </a>
        </ul>
        <ul class="nav navbar-nav navbar-toggler">
            <a href="{{ route('posts.index') }}"> Posts </a>
        </ul>

        <div class="nav navbar-nav navbar-right">
            {{$browsers}}
        </div>
    </div>
</nav>