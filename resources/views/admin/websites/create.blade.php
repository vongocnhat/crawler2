@extends('admin.layouts.default')
@section('content')

{{ Form::open(array('route'=>'website.store','method'=>'post'))}}
<div class="container">
<h1 >Create </h1>
<hr>
<div class="form-group">
{{ Form::label('domainName','DomainName')}}
{{ Form::text('domainName',null, ['class'=>'form-control', 'required' => 'required']) }}
</div>  
<div class="form-group">
{{ Form::label('menuTag','MenuTag ')}} 
{{ Form::text('menuTag',null,['class'=>'form-control', 'required' => 'required'])}}
</div>
<div class="form-group">
{{form::label('numberPage','NumberPage')}}
{{form::number('numberPage', 5,['class'=>'form-control', 'required' => 'required'])}}
</div>
<div class="form-group">
{{form::label('limitOfOnePage','LimitOfOnePage:')}}
{{form::number('limitOfOnePage', 0,['class'=>'form-control', 'required' => 'required'])}}
</div>
<div class="form-group">
{{form::label('stringFirstPage','StringFirstPage:')}}
{{form::text('stringFirstPage',null,['class'=>'form-control', 'required' => 'required'])}}
</div>
<div class="form-group">
{{form::label('stringLastPage','StringLastPage:')}}
{{form::text('stringLastPage',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
  {{Form::label('ignoreWebsite','Bỏ Qua Các Đường Dẫn ( Không bắt buộc ):')}}
  {{Form::textarea('ignoreWebsite', null, ['class'=>'form-control', 'rows' => '4'])}}
  <span>
    Các đường dẫn được ngăn cách bởi đấu ;<br>
    Ví dụ: https://www.24h.com.vn/tin-tuc-trong-ngay-c46.html;https://www.24h.com.vn/bong-da-c48.html
  </span>
</div>
  <div class="form-group" >
    {{form::label('Active','Active:')}}
    <div class="form-check form-check-inline">
      {!! Form::radio('active',1, true, ['class' =>'form-check-input', 'id' => 'yes']) !!}
      {{Form::label('yes','Yes',['class'=>'form-check-label'])}}
     </div>
    <div class="form-check form-check-inline">
      {!!Form::radio('active',0, null, ['class' =>'form-check-input', 'id' => 'no'])!!}
      {{Form::label('no','No',['class'=>'form-check-label'])}}  
    </div>
  </div>
<div class="form-group">
{{form::submit('Send to as admin',['class'=>'btn btn-primary'])}}
</div>


</div>
  {!! Form::close() !!}

</div>
@stop