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
      <a href="{{route('keyword.create')}}">
         <button class="btn btn-primary">
        <span class="far fa-address-book"></span>
           Create
         </button>
      </a>
        <div class="card-body card-body-padding">

          <div class="table-responsive">
            {{ Form::model(['route'=>['keyword.update', 0],'method'=>'put'], ['class' => 'formEdit']) }}

            {{ Form::close() }}
            {!! Form::open(['method' => 'DELETE', 'route' => ['keyword.destroy', 'keyword' => 0]]) !!}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger btnDelete', 'onclick' => "return confirm('Xóa Tất Cả Nội Dung Được Checked Trong Trang Này ?')"]) }}
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Update</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Update</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($keyWord as $data)
                  <tr>
                    <td><input type="checkbox" class="checkbox-delete" name="idCheckbox[]" value="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{ $data->category->name }}</td>
                    <td>{{$data->name}}</td>
                    <td>
                      <label><input type="checkbox" class="tdCbActive" value="{{ $data->id }}" {{$data->active ? 'checked="checked' : '' }}"><span>{{ $data->active ? ' Yes' : ' No' }}</span></label>
                    </td>
                    <td><a href="{{ URL::route('keyword.edit', ['keyword' => $data->id]) }}" class="btn btn-success">Edit</a></td>
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
@section('script')
  <script type="text/javascript">
    $('.tdCbActive').click(function() {
      var id = $(this).val();
      $.ajax({
        url: '{{ route('keyword.active') }}',
        data: {id: id}
      });
    });
  </script>
@stop