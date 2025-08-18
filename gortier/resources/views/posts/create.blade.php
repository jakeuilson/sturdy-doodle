@extends('layouts.app')

@section('content')
    <h2>New Post</h2>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label>Title
            <input type="text" name="title" value="{{ old('title') }}" required>
        </label>
        <br>
        <label>Body
            <textarea name="body" rows="6" required>{{ old('body') }}</textarea>
        </label>
        <br>
        <button type="submit">Publish</button>
    </form>
@endsection