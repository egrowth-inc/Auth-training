<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">編集</a>
    @endcan

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    @endcan
@endsection
