@extends('layouts.back')

@section('content')
    <div class="postsShow text-center my-5">
        <h1>{{$post->title}}</h1>
        <p>{{$post->content}}</p>
        <p><a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a></p>
        <h5>Tags</h5>
        @foreach ($post->tags as $tag)
        <p>{{$tag->name}}</p>
        @endforeach
        
        <h5>Pubblicato: {{$post->published ? 'si' : 'no'}}</h5>
    </div>
    
@endsection