@extends('admin.layouts.default')
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
      <a href="{{route('detailwebsite.create')}}">
         <button class="btn btn-primary">
        <span class="far fa-address-book"></span>
           Create
         </button>
      </a>
        <div class="card-body card-body-padding">
          <div class="table-responsive">
            {!! Form::open(['method' => 'DELETE', 'route' => ['detailwebsite.destroy', 'detailwebsite' => 0]]) !!}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger btnDelete', 'onclick' => "return confirm('Xóa Tất Cả Nội Dung Được Checked Trong Trang Này ?')"]) }}
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>DomainName</th>
                    <th>ContainerTag</th>
                    <th>TitleTag</th>
                    <th>DescriptionTag</th>
                    <th>PubDateTag</th>
                    <th>Active</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th><input type="checkbox" class="parent-checkbox-delete"></th>
                    <th>Id</th>
                    <th>DomainName</th>
                    <th>ContainerTag</th>
                    <th>TitleTag</th>
                    <th>DescriptionTag</th>
                    <th>PubDateTag</th>
                    <th>Active</th>
                    <th>Edit</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($detailWebsites as $data)
                  <tr>
                    <td><input type="checkbox" class="checkbox-delete" name="idCheckbox[]" value="{{$data->id}}"></td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data['website']->domainName }}</td>
                    <td>{{ $data->containerTag }}</td>
                    <td>{{ $data->titleTag }}</td>
                    <td>{{ $data->descriptionTag }}</td>
                    <td>{{ $data->pubDateTag }}</td>
                    <td>
                      <label><input type="checkbox" class="tdCbActive" value="{{ $data->id }}" {{$data->active ? 'checked="checked' : '' }}"><span>{{ $data->active ? ' Yes' : ' No' }}</span></label>
                    </td>
  						      <td><a href="{{ URL::route('detailwebsite.edit', ['detailwebsite' => $data->id]) }}" class="btn btn-success">Edit</a></td>
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
        url: '{{ route('detailwebsite.active') }}',
        data: {id: id}
      });
    });
  </script>
@stop