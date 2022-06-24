@extends('layouts.back')

@section('content')
<form action="{{route('admin.tags.update', $tag->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Titolo</label>
      <input type="name" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" placeholder="Inserisci nome Tag" value="{{$tag->name}}">
      @error('name')
            <div class="alert alert-danger">
                Tag non valido
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection