@extends('layouts.app')

@section('content')
    <h1>All Blog Posts</h1>
    @foreach ($posts as $post)
        <article>
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p>By {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d') }}</p>
            <p>{{ Str::limit($post->body, 150) }}</p>
            <p>Comments: {{ $post->comments_count }}</p>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection