@extends('layouts.app')
@Section('content')
<div class="card text-center my-5 mx-auto" style="width: 18rem;">
    <img class="card-img-top" src="{{asset('images/posts/'.$post->image)}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$post['title']}}</h5>
      <p class="card-text">{{$post['body']}}</p>
      <p class="card-text">{{$post['creation']}}</p>
      <a href="/posts" class="btn btn-primary">Go Back</a>
    </div>
  </div>
@endsection