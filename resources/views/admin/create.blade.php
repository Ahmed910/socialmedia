@extends('layouts.master')
@section('content')
@include('partials.errors')
<div class="alert alert-danger" id="errormsg">

</div>
<div class="row">
    <div class="col-md-12">
    <form method="post" action="{{route('admin.create')}}" id="createpost">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name="content">
        </div>
        @foreach($tags as $tag)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
            </label>
        </div>
        @endforeach
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>


@push('scripts')


<script type="text/javascript">
    $(function () {
       $('#errormsg').hide();
       $("#createpost").submit(function (e) {
           e.preventDefault();
           var _token=$("input[name='_token']").val();
           var _title=$("input[name='title']").val();
           var _content=$("input[name='content']").val();
           var _tags=new Array();
            $("input[name='tags[]']").each(function(){
                if($(this).is(":checked")){
                _tags.push($(this).val());
               }

            });

           var data=new FormData();
           data.append('_token',_token);
           data.append('title',_title);
           data.append('content',_content);
           $.each(_tags,function(k,v){
            data.append('tags',v);
           });

           $.ajax({
             url:"{{ route('admin.create') }}",
             type:"POST",
             data:data,
             contentType: false,
             processData: false,
             success:function(data){
               alert('post added successfully');
             },
             error:function(data){
                 $('#errormsg').show();
                 $('#errormsg').html('');
                 var errors=data.responseJSON;
                 $.each(errors,function(k,v){
                   $('#errormsg').append(v+'<br>');
                 });
             }
           });
           this.reset();
       });
    });
</script>
@endpush

@endsection


