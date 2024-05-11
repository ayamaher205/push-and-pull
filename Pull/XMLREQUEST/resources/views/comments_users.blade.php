@extends('Layouts.app')
@Section('body')
@foreach($posts->comments as $comment )
<p>
    {{$comment->content}}
</p>
@endforeach
@endsection