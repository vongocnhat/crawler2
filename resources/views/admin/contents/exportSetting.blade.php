@extends('admin.layouts.default')
<!-- declase the ingredient of layout master -->
@section('Title', 'Export Setting')
@section('content')
 {{ Form::open(['route'=>'content.export', 'method'=>'post']) }}
  <div class="row">
    <div class="col-6">
      <div class="form-group">
        {{ Form::label('widthTitle', 'Chiều Dài Cột TIÊU ĐỀ TIN') }}
        {{ Form::text('widthTitle', 50, ['class'=>'form-control', 'required']) }}
      </div>
    </div>
    <div class="col-6">
      <div class="form-group" >
        {{ Form::label('wrapTitle', 'Warp Text Title:') }}
        <div class="form-check form-check-inline">
          {{ Form::radio('wrapTitle', 1, true, ['class' =>'form-check-input', 'id' => 'wrapTitleYes']) }}
          {{ Form::label('wrapTitleYes', 'Yes', ['class'=>'form-check-label']) }}
         </div>
        <div class="form-check form-check-inline">
          {{ Form::radio('wrapTitle', 0, null, ['class' =>'form-check-input', 'id' => 'wrapTitleNo']) }}
          {{ Form::label('wrapTitleNo', 'No', ['class'=>'form-check-label']) }}  
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <div class="form-group">
        {{ Form::label('widthDescription', 'Chiều Dài Cột TÓM LƯỢC TIN') }}
        {{ Form::text('widthDescription', 50, ['class'=>'form-control', 'required']) }}
      </div>
    </div>
    <div class="col-6">
      <div class="form-group" >
        {{ Form::label('wrapDescription', 'Warp Text Description:') }}
        <div class="form-check form-check-inline">
          {{ Form::radio('wrapDescription', 1, true, ['class' =>'form-check-input', 'id' => 'wrapDescriptionYes']) }}
          {{ Form::label('wrapDescriptionYes', 'Yes', ['class'=>'form-check-label']) }}
         </div>
        <div class="form-check form-check-inline">
          {{ Form::radio('wrapDescription', 0, null, ['class' =>'form-check-input', 'id' => 'wrapDescriptionNo']) }}
          {{ Form::label('wrapDescriptionNo', 'No', ['class'=>'form-check-label']) }}  
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    {{ Form::submit('Xuất File Excel', ['class'=>'btn btn-primary']) }}
  </div>
  </div>
{!! Form::close() !!}
@stop