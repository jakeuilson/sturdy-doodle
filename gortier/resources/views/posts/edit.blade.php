@extends('layouts.app')

@section('content')
    <h2>Edit Post</h2>
    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')
        <label>Title
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </label>
        <br>
        <label>Body
            <textarea name="body" rows="6" required>{{ old('body', $post->body) }}</textarea>
        </label>
        <br>
        <button type="submit">Update</button>
    </form>
@endsection