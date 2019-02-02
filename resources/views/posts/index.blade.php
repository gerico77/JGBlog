@extends('layouts.app') 
@section('content')
    <h1>Posts</h1>
    <div class="row my-4">
        @if(count($posts) > 0) 
            @foreach($posts as $post)
                <div class="col-lg-3 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="/posts/{{ $post->id }}"><img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}"></a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h5>
                            <small>Posted on {{ $post->created_at }}
                            <br />
                            by {{ $post->user->name }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
    {{$posts->links()}}
@endsection