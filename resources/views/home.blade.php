@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                  <h2>Your Posts</h2>
                  @if (count($posts))
                    <table class="table table-striped">
                      <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                      </tr>
                      @foreach ($posts as $post)
                        <tr>
                          <td>{{$post->title}}</td>
                          <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                        <td>
                            <form method="Post" action="/posts/{{$post->id}}" >
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  @else
                    <h3>You Have Po Posts Yet</h3>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
