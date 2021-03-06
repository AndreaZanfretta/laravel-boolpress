@extends('layouts.back')

@section('content')
    <div class="postsShow text-center my-5 ">
        @if ($post->image)
            <div class="text-center w-25 mt-3 image-container">
                <img src="{{ asset('storage/' . $post->image) }}" class="rounded "
                    alt="{{ $post->title }}">
            </div>
        @endif
        <h1>{{$post->title}}</h1>
        <p>{!! $post->content !!}</p>
        <p><a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a></p>
        <h5>Tags</h5>
        @foreach ($post->tags as $tag)
        <p><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a></p>
        @endforeach
        
        <h5>Pubblicato: {{$post->published ? 'si' : 'no'}}</h5>
    </div>
    
@endsection