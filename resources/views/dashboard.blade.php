@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <a href="/posts/create" class="btn btn-primary">Create Post</a>
                <h3 class="mt-4">Your Blog Posts</h3>
                @if(count($posts) > 0)
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-success">Edit</a></td>
                                <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!} 
                                    {{ Form::hidden('_method', 'DELETE') }} 
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
                                    {!! Form::close() !!}
                                </td>
                        @endforeach
                    </table>
                @else
                    <p>You have no posts</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
