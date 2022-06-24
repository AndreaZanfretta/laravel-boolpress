@extends('layouts.back')

@section('content')
<form action="{{route('admin.tags.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Titolo</label>
      <input type="name" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" placeholder="Inserisci nome tag" value="{{old('name')}}">
      @error('name')
            <div class="alert alert-danger">
                Tag non valido
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection