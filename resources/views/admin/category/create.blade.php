@extends('admin.layouts.default')
<!-- declase the ingredient of layout master -->
@section('Title','get persional list')
@section('content')
{{ Form::open(array('route'=>'category.store', 'method'=>'post'))}}
  <div class="container-fluid">
    <h1 >Create Category</h1><hr>
    <div class="row">
      @if(Session::has('ketqua')) 
          <p class="alert alert-success">{{Session::get('ketqua')}}</p>
      @endif
    </div>
  </div>
  <div class="form-group">
    {{Form::label('name','Name:')}}
    {{Form::text('name', null, ['class'=>'form-control', 'required'])}}
  </div>
  <div class="form-group">
    {{Form::label('description','Description ( Không bắt buộc ):')}}
    {{Form::textarea('description', null, ['class'=>'form-control', 'rows' => '4'])}}
  </div>
  <div class="form-group">
    {{form::submit('Save',['class'=>'btn btn-primary'])}}
  </div>
{!! Form::close() !!}

  
@stop
    <!-- Bootstrap core JavaScript-->
