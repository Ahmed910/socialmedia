@extends('layouts.master')
@section('content')
@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
    <p class="alert alert-info">{{ Session::get('info') }}</p>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12">

    <a href="{{route('admin.create')}}" class="btn btn-success">New Post</a>
    </div>
</div>
@foreach($posts as $post)
<div class="row">
    <div class="col-md-6">
    @if(!Gate::denies('manipulate-post',$post))
    <p><strong>{{$post->title}}</strong>

    <a href="{{route('admin.edit',['id'=>$post->id])}}">Edit</a>
    <a href="{{route('admin.delete',['id'=>$post->id])}}">delete</a>

    @endif

</p>

    </div>

</div>
@endforeach

<div class="row">
    <div class="col-md-4">
        <h3>Online Users</h3>
        <hr>
        <h5 id="no-online-users">No Online Users</h5>
        <online-users/>
    </div>
</div>

@endsection
