@extends('layouts.master')

@section('content')
  <div class="col-md-12 col-lg-12">
    @if (count($posts))
      @foreach ($posts as $post)
        <div class="well">
          <div class="row">
            <div class="col-lg-3 col-md-3">
              <img src="/storage/cover_images/{{$post->cover_image}}" width="100%" alt="{{$post->cover_image}}">
            </div>
            <div class="col-lg-8 col-md-8">
              <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <p>{{$post->body}}</p>
                <p><small>Created On {{$post->created_at->toFormattedDateString()}} By {{$post->user->name}}</small></p>
            </div>
          </div>
        </div>

      @endforeach
    @else
      <h3>There Is No Posts Yet</h3>
    @endif
    {{-- {{$posts->links()}} --}}
  </div>
@endsection
