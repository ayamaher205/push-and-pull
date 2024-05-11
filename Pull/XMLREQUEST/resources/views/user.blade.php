@extends('layouts.app')
@section('content')
<h1 class="text-center fs-4">User Profile</h1>
<div class="container my-5 mx-5">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Full Name</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$user['name']}}</p>
          </div>
        </div>
      </div>
    </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Email</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$user['email']}}</p>
          </div>
        </div>
        <hr>
        </div>
      </div>
      <h2 class='text-center'>Posts</h2>
      <div class="wrapper mx-5">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">image</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">body</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts as $post)
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/posts/' . $post->image) }}" alt=""
                                    style="width: 45px; height: 45px" class="rounded-circle" />
                            </div>
                        </td>
                        <td class="text-center">
                            <p class="fw-bold mb-1">{{ $post->title }} </p>
                        </td>
                        <td class="text-center">
                            <p class="fw-normal mb-1">{{ $post->body }}</p>
                        </td>
                        <td class="text-center">
                            <button rel='tooltip' id="del" class='btn btn-danger btn-just-icon btn-sm' type="button"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}">
                                Delete
                            </button>
                            <a rel='tooltip' class='btn btn-success btn-just-icon btn-sm' data-original-title='' title=''
                                href="/posts/{{ $post->id }}/edit">
                                edit
                            </a>
                            <a rel='tooltip' class='btn btn-secondary btn-just-icon btn-sm' data-original-title=''
                                title='' href="/posts/{{ $post->id }}" {{-- {{route('posts.show',$user['id'])}} --}}>
                                Show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection