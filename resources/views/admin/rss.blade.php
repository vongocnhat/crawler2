<!DOCTYPE html>
<html>
<head>
	<title>Trang Lấy Tin Tức</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<a class="btn btn-success" href="{{ route('home') }}">Home</a><br>
<div class="row">
	<div class="col-6">
		<table class="table table-bordered">
		  <thead>
		    <tr>
		      <th scope="col" style="color: green">Success</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($linkSuccesses as $linkSuccess)
		    <tr>
		      <th scope="row" style="color: green">{{ $linkSuccess }}</th>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
	@if ($linkErrors)
	<div class="col-6">
		<table class="table table-bordered col-6">
		  <thead>
		    <tr>
		      <th scope="col" style="color: red">Errors</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($linkErrors as $linkError)
		    <tr>
		      <th scope="row" style="color: red">{{ $linkError }}</th>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
	@endif
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
	if ({{ $refreshTime }} > 0) {
		setTimeout(function () {
			location.reload();
		}, '{{ $refreshTime }}');
	}
</script>
</body>
</html>