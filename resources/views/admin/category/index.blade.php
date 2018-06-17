@extends('admin.layouts.default')
@section('title',"Kiem Tra")
@section('content')
      <!-- Breadcrumbs-->
      <div class="row">
  @if(Session::has('ketqua')) 
    <p class="alert alert-success">{{Session::get('ketqua')}}</p>
  @endif
</div>
      <!-- Example DataTables Card-->
      <div class="card">
        <div class="card-header card-header-padding">
         
          <a href="{{URL::route('category.create')}}">
             <button class="btn btn-primary">
            <span class="far fa-address-book"></span>
               Create
             </button>
          </a>
          
        <div class="card-body card-body-padding">

          <div class="table-responsive">
            {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', 'category' => 0]]) !!}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger btnDelete', 'onclick' => "return confirm('Xóa Tất Cả Nội Dung Được Checked Trong Trang Này ?')"]) }}
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Edit</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($categories as $data)
                  <tr>
                    <td><input type="checkbox" class="checkbox-delete" name="idCheckbox[]" value="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td><a href="{{ URL::route('category.edit', ['category' => $data->id]) }}" class="btn btn-success">Edit</a></td>
                  </tr>
            @endforeach
        </tbody>
    </table>
    {!! Form::close() !!}
</div>
</div>
</div>
</div>
@stop