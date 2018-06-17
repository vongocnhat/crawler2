@extends('admin.layouts.default')
<!-- declase the ingredient of layout master -->
@section('Title','get persional list')
@section('content')
 {{ Form::model($edit,array('route'=>array('content.update',$edit->id),'method'=>'put'))}}
  <div class="container">
  <h1 >Edit </h1>
  <hr>
  <div class="form-group">
    {{ Form::label('category_id', 'Category Name:') }}
    {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Category Name', 'required']) }}
  </div>
  <div class="form-group">
    {{ Form::label('title','title ')}}
    {{ Form::text('title',null,['class'=>'form-control', 'required' => 'required'])}}
  </div>
  <div class="form-group">
    {{form::label('link','link')}}
    {{form::text('link',null,['class'=>'form-control', 'required' => 'required'])}}
  </div>
  <div class="form-group">
    {{form::label('description','description:')}}
    {{form::textarea('description',null,['class'=>'form-control', 'rows' => 5])}}
  </div>
  <div class="form-group" >
    {{form::label('Active','Active:')}}
    <div class="form-check form-check-inline">
      {{ Form::radio('active',1, true, ['class' =>'form-check-input', 'id' => 'yes']) }}
      {{Form::label('yes','Yes',['class'=>'form-check-label'])}}
     </div>
    <div class="form-check form-check-inline">
      {{Form::radio('active',0, null, ['class' =>'form-check-input', 'id' => 'no'])}}
      {{Form::label('no','No',['class'=>'form-check-label'])}}  
    </div>
    <div class="form-group">
      {{form::label('sourceOfNews','SourceOfNews (Nguồn):')}}
      {{form::text('sourceOfNews',null,['class'=>'form-control', 'required' => 'required'])}}
    </div>
  </div>
  <div class="form-group">
    {{form::submit('Update',['class'=>'btn btn-primary'])}}
  </div>
      {!! Form::close() !!}
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
@endsection
@section('script')
<script type="text/javascript" src="vendor/select2/select2.min.js" ></script>
<script>
    $(document).ready(function(){
        $('select').select2();
    });
</script>
@endsection