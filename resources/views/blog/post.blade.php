@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
    <p class="qoute">{{$post->title}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <p> {{ count($post->likes) }} Likes |
    <a href="{{ route('blog.post.like',['id'=>$post->id]) }}">Like</a>
     </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <p> {{ $post->content }} </p>
    </div>
</div>

@if($comments->count() > 0)
@foreach ($comments as $comment)
<div class="row">
    <div class="col-md-12">
    <span>{{ $comment->name }} commented : </span><span> {{ $comment->body }} </span>
    </div>
</div>
@endforeach

@else
<div class="row">
    <div class="col-md-12">
    <p> There Is Not Found Comments On This Post </p>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-12">
    <form method="POST" action="{{ route('admin.saveComment') }}">
        @csrf
    <div class="form-group">
       <input type="text" name="body" class="form-control" placeholder="write comment...">
    </div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="submit" value="Write Comment" class="btn btn-success">
    </form>
    </div>
</div>

@endsection