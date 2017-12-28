@extends('layouts.master')

@section('content')
  <h2>welcome to services page</h2>
  @if (count($services))
    <ul class="list-group">
      @foreach ($services as $service)
        <li class="list-group-item">{{$service}}</li>
      @endforeach
    </ul>
  @endif
@endsection
