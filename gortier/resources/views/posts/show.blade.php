@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>
    <p>By {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d') }}</p>
    <p>{{ $post->body }}</p>

    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}">Edit</a>
    @endcan
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endcan

    <hr>

    <h3>Comments</h3>
    @forelse ($post->comments as $comment)
        <div>
            <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->diffForHumans() }}):
            <p>{{ $comment->body }}</p>
        </div>
    @empty
        <p>No commentary yet</p>
    @endforelse

    @auth
        <form method="POST" action="{{ route('comments.store', $post) }}">
            @csrf
            <textarea name="body" rows="3" required placeholder="Add a comment"></textarea>
            <button type="submit">Post Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to comment.</p>
    @endauth
@endsection