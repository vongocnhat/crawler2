@extends('admin.layouts.default')
<!-- declase the ingredient of layout master -->
@section('Title','get persional list')
@section('content')
{{ Form::open(array('route'=>'rss.store', 'method'=>'post'))}}
  <div class="container-fluid">
    <h1 >Create RSS</h1><hr>
    <div class="row">
      @if(Session::has('ketqua')) 
          <p class="alert alert-success">{{Session::get('ketqua')}}</p>
      @endif
    </div>
  </div>
  <div class="form-group">
    {{Form::label('link','Đường Dẫn RSS:')}}
    {{Form::text('link', null, ['class'=>'form-control', 'required'])}}
  </div>
  <div class="form-group">
    {{Form::label('ignoreRSS','Bỏ Qua Các Đường Dẫn RSS ( Không bắt buộc ):')}}
    {{Form::textarea('ignoreRSS', null, ['class'=>'form-control', 'rows' => '4'])}}
    <span>
      Các đường dẫn được ngăn cách bởi đấu ;<br>
      Ví dụ: 24h.com.vn/upload/rss/tintuctrongngay.rss;24h.com.vn/upload/rss/bongda.rss
    </span>
  </div>
  <div class="form-group">
    {{Form::label('website','Đường Dẫn Trang Web Cộng Thêm ( Không bắt buộc ):')}}
    {{Form::text('website', null, ['class'=>'form-control'])}}
    Ví dụ: Đường dẫn rss có dạng: /upload/rss/tintuctrongngay.rss thì phải cộng thêm 24h.com.vn
  </div>
  <div class="form-group">
    {{form::submit('Save',['class'=>'btn btn-primary'])}}
  </div>
{!! Form::close() !!}

  
@stop
    <!-- Bootstrap core JavaScript-->
