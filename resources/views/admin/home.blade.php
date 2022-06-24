@extends('layouts.back')
<link href="{{ asset('css/back.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <br>
                    <a href="{{route('admin.posts.index')}}">
                        <div class="btn btn-info">Lista Post</div>
                    </a>
                    <a href="{{route('admin.categories.index')}}">
                        <div class="btn btn-info">Lista Categorie</div>
                    </a>
                    <a href="{{route('admin.tags.index')}}">
                        <div class="btn btn-info">Lista Tags</div>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
