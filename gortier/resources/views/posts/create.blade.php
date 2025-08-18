@extends('layouts.app')

@section('content')
    <h2>New Post</h2>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="body" placeholder="Body" required></textarea>
        <button type="submit">Create Post</button>
    </form>
@endsection