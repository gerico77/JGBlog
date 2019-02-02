@extends('layouts.app') 
@section('content')
    <a href="/posts" class="btn btn-outline-primary">Back</a>
    <div class="row my-4">
        <div class="col-sm-4">
            <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}">
        </div>
        <div class="col-sm-8">
            <h1>{{ $post->title }}</h1>
            <hr />
            <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small>
            <hr />
            <p>{!! $post->body !!}</p>
            @auth
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-success">Edit</a>
            
                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {!! Form::close() !!}
                @endif
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($post->comments as $comment)
                
                <div  class="comment">
                    <p><strong>Name:</strong> {{ $comment->name }} </p>
                    <p><strong>Comment:</strong><br> {!! $comment->comment !!}</p><br>
                <div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px; ">
            {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
    
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', "Name:") }}
                    @guest
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @endguest
                    @auth
                        {{ Form::text('name', $post->user->name, ['class' => 'form-control', 'disabled']) }}
                    @endauth
                </div>
    
                <div class="col-md-6">
                    {{ Form::label('email', "Email:") }}
                    @guest
                        {{ Form::text('email', null, ['class' => 'form-control']) }}
                    @endguest
                    @auth
                        {{ Form::text('email', $post->user->email, ['class' => 'form-control', 'disabled']) }}
                    @endauth
    
                </div>
                <div class="col-md-12">
                    {{ Form::label('comment', "Comment:") }} 
                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

                    {{ Form::submit('Add Comment', ['class' => 'btn btn-success', 'style' => 'margin-top:15px;'])}}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection