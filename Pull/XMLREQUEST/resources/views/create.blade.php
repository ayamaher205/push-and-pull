@extends('layouts.app')
@Section('content')
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="m-5">
        @csrf
        <div class="form-group my-5">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title"
                value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger mt-5">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group my-5">
            <label for="formGroupExampleInput2">Body</label>
            <input type="text" class="form-control" id="body" name="body" placeholder="Enter body"
                value="{{ old('body') }}">
            @error('body')
                <div class="alert alert-danger mt-5">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group my-5">
            <label for="formGroupExampleInput2">tags</label>
            <input type="text" class="form-control" id="body" name="tags" placeholder="Enter Tags"
                value="{{ old('body') }}">
        </div>
        <div class="form-group my-5">
            <label for="exampleFormControlFile1" class="d-block">upload post image</label>
            <input type="file" class="form-control-file d-block" id="image" name="image">
            @error('image')
                <div class="alert alert-danger mt-5">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save Post</button>
    </form>
@endsection
