@extends('admin.layouts.default')
<!-- declase the ingredient of layout master -->
@section('Title','Edit KeyWord')
@section('content') 
<div class="container-fluid">
  <h1 >Create </h1><hr>
  <div class="row">
    @if(Session::has('ketqua')) 
        <p class="alert alert-success">{{Session::get('ketqua')}}</p>
    @endif
  </div>
  {{ Form::model($edit,array('route'=>array('keyword.update',$edit->id),'method'=>'put'))}}
    <div class="form-group">
      {{ Form::label('category_id', 'Category Name:') }}
      {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Category Name', 'required']) }}
    </div>
    <div class="form-group">
      {{ Form::label('name','Name')}}
      {{ Form::text('name', null, ['class'=>'form-control', 'required']) }}
    </div>
    <div class="form-group">
      {{form::label('active','Active:')}}
    <div class="form-check form-check-inline">
      {!! Form::radio('active',1, true, ['class' =>'form-check-input', 'id' => 'yes']) !!}
      {{Form::label('yes','Yes',['class'=>'form-check-label'])}}
    </div>
    <div class="form-check form-check-inline">
      {!!Form::radio('active',0, null, ['class' =>'form-check-input', 'id' => 'no'])!!}
      {{Form::label('no','No',['class'=>'form-check-label'])}}  
    </div>
    <div class="form-group">
      {{form::submit('Save',['class'=>'btn btn-primary'])}}
    </div>
  {!! Form::close() !!}
</div>
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