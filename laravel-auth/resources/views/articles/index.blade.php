@extends('layouts.app')

@section('content')
    <h1>Articles</h1>

    @can('edit articles')
        <a href="{{ route('articles.create') }}">Create New Article</a>
    @endcan

    @foreach ($articles as $article)
        <div>
            <h2>{{ $article->title }}</h2>
            @can('edit articles')
                <a href="{{ route('articles.edit', $article->id) }}">Edit</a>
            @endcan
        </div>
    @endforeach
@endsection
