@extends('layouts.master')
@section('content')
@include('partials.errors')
<div class="row">
    <div class="col-md-12">
    <form method="post" action="{{route('admin.update')}}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title"
            value="{{ $post->title }}" name="title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content"
            value="{{ $post->content }}" name="content">
        </div>
        @foreach($tags as $tag)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                 {{ $post->tags->contains($tag->id)? 'checked':'' }}>{{ $tag->name }}
                
            </label>
        </div>
        @endforeach
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{ $postId }}" >
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>


@endsection