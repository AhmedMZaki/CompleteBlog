@extends('layouts.master')

@section('content')
<div class="container">
  <div class="col-lg-8 col-md-8">
    <form method="post" action="/posts" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title" id="title" required>
    </div>
    <div class="form-group">
      <label for="body">Body</label>
      <textarea name="body" class="form-control" id="body" rows="8" cols="78" required></textarea>
    </div>
    <div class="form-group">
      <input type="file" class="form-control" name="cover_image" id="cover_image"/>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
    </div>
      @include('inc.errors')
  </form>

  </div>
</div>

@endsection
