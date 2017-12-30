@extends('layouts.master')

@section('content')
  <div class="col-md-12 col-lg-12">
    <div class="well">
      <a href="/posts" class="btn btn-primary">back</a><br><br>
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <img src="/storage/cover_images/{{$post->cover_image}}" width="100%" alt="{{$post->cover_image}}">
        </div>
          <div class="col-lg-8 col-md-8">
            <h1>{{$post->title}}</h1>
              <p>{{$post->body}}</p>
              <p><small>Created On {{$post->created_at->toFormattedDateString()}} By {{$post->user->name}}</small></p>
              <hr>
              <div class="row">
                @if (Auth::check()&&(auth()->user()->id==$post->user->id))
                <a href="/posts/{{$post->id}}/edit" title="edit '{{$post->title}}' ">Edit</a>
                <form method="Post" action="/posts/{{$post->id}}" >
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-danger pull-right">Delete</button>
                </form>
              @endif
              </div>
          </div>
      </div>
      <br>
      @if (count($post->comments) > 0)
        <div class="row">
          <ul class="list-group">
            @foreach ($post->comments as $comment)
              <p class="list-group-item"><b>{{$comment->user->name}}: </b> {{$comment->body}} &#32 <small>Created On  {{$post->created_at->toFormattedDateString()}}</small></p>

            @endforeach
          </ul>
        </div>
      @endif
      <br>
      <div class="row">
        <div class="col-lg-8">
            <form method="post" action="/posts/{{$post->id}}">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="body">Write Comment</label>
            <textarea name="body" class="form-control" id="body" required></textarea>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">Comment</button>
          </div>
        </form>
        </div>
      </div>
    </div>

</div>
@endsection
