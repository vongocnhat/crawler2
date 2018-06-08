@extends('admin.layouts.default')
@section('content')
@if(Session::has('thongbao'))
  <span class="alert alert-success">{{ Session::get('thongbao') }}</span>
@endif
</div>
{!! Form::model($category, ['route' => ['category.update', 'id' => $category->id], 'method' => 'put', 'class' => 'col-12']) !!}
  <div class="container-fluid">
    <h1>Edit Category</h1><hr>
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
@endsection