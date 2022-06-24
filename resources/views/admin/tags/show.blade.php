@extends('layouts.back')

@section('content')
    <div class="tagShow text-center my-5">
        <h1>{{$tag->name}}</h1>
        <h2>Post pubbicati con questo tag:</h2>
        <ul>
            @foreach ($tag->posts as $post)
                <li><a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></li>
            @endforeach
        </ul>
    </div>
    
    
    
@endsection