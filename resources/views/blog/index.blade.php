 @extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
    <p class="qoute">The beautiful laravel</p>
    </div>
</div>

  @foreach($posts as $post)
<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="post-title">{{$post->title}}</h1>
        <p style="font-weight: bold">
        @foreach($post->tags as $tag)
        - {{ $tag->name }} -
        @endforeach
    </p>
    <p>{{$post->content}}</p>
    <a href="{{route('blog.post',['id'=>$post->id])}}">Read more ....</a>
    </div>
</div>
<hr>
@endforeach
<div class="row">
    <div class="col-md-12 text-center">
        {{ $posts->links("pagination::bootstrap-4") }}
    </div>
</div>   
 
@endsection  

<!-- <button class="btn btn-primary" id="btn">Get Posts</button>
<div class="row">
    <div class="col-md-12 text-center title">
   
    </div>
</div>  -->

<!-- @section('script')
 <script> -->
     
<!-- //  $(document).ready(function(){
//      console.log('ok');
//  $('#btn').click(function(){
//     console.log('ok');
//    $.ajax({
//     url:'{{ URL::current() }}',
//     type:'get',
//     dataType:'json',
//     data:{},
//     success: function(response){
//     // $(".title").html(response.data);
//      console.log(response.data);
//     }
//    });
//    return false;
//    // $.get("{{ route('blog.index') }}",function(re,status){
//  //console.log(re);
 
//  });
//  });
// console.log("{{ route('blog.index') }}");
 var req=new XMLHttpRequest();
 req.onreadystatechange=function(){
    if(req.readyState==req.DONE && req.status==200){
         console.log(JSON.parse(req.response));
     }
 }
 req.open("GET","{{ route('blog.index') }}");
 req.send(); -->
<!-- </script>  -->
<!-- @endsection -->
