<!DOCTYPE html>
<html>
<head>
	<title>
  @if (isset($categoryID))
    {{ $categories->find($categoryID)->name }}
  @else
    Tất cả tin tức
  @endif 
  </title>
	<base href="{{ asset("/") }}">
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="styles/dialog.css">
  <link rel="stylesheet" type="text/css" href="styles/nhat.css">
</head>
<body>
<img src="images/logo2.jpg" width="100%">
@include('menu')
<br>
<div class="news-container col-12">
  <div class="col-md-4 col-sm-12">
    {{ Form::open(['route' => isset($categoryID) ? ['categoryCus.show', $categoryID] : 'homePage', 'method' => 'get', 'class' => 'row']) }}
      <div class="input-group">
        {{ Form::search('searchStr', $searchStr, ['class' => 'form-control', 'placeholder'=>'Search for...']) }}
        <span class="input-group-btn">
          {{ Form::submit('Tìm', ['class' => 'btn btn-success']) }}
        </span>
      </div>
      Số Lượng Tin Trên 1 Trang:
      <div class="input-group">
        {{ Form::number('perPage', Session::get('perPage'), ['class' => 'form-control', 'required']) }}
        <span class="input-group-btn">
          {{ Form::submit('OK', ['class' => 'btn btn-success']) }}
        </span>
      </div>
    {{ Form::close() }}
  </div>

  <div class="contents-ajax">
    @include('contents-ajax')
  </div>
</div>
<div class="box-dialog">
  <img src="images/ajax-loader.gif" id="loading-indicator" style="display:none" />
  <div class="box-news">
    <button class="btn-close btn btn-danger float-right box-dialog-header" title="Nhấn ESC Để Tắt">X</button>
    <div class="box-news-content holds-the-iframe" style="display: flex;">

    </div>
  </div>
</div>
<div id="script"></div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">

{{-- // var refreshTime = {{ $refreshTime }}; --}}
// if(refreshTime <= 0)
//   refreshTime = 15000;
// function myLoop () {           //  create a loop function
//    setTimeout(function () { 
//     $.ajax({
{{-- //       url: '{{ route('news-container') }}', --}}
//       success: function(result) {
//         $(".news-container").html(result);
//       }
//     });
//     myLoop();
//   }, refreshTime);
// }
// myLoop();
</script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="styles/function.js"></script>
<script type="text/javascript" src="styles/content-pagination-ajax.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $(".box-news").click(function(e) {
    e.stopPropagation();
  });
  $(".news-container").on('click', '.box-news-content', function(e) {
    e.preventDefault();
  });
  // button title click, // button image click ajax nen lam nhu vay
  $(".news-container").on('click', '.btn-title, .btn-image > a', function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    $('#loading-indicator').show();
    //get news
    $.ajax({
      url: '{{ route('getNews') }}',
      data: {href: href},
      success: function(result) {
        $('#loading-indicator').hide();
        $(".box-news-content").html(result);
    }});
    $(".box-dialog").show(500);
    setTimeout(function () { 
      $("body").css({'overflow': 'hidden', 'margin-right': getScrollbarWidth()});
    }, 500);
    
    $(".box-dialog").scrollTop(0);
  });
  // button close click and dialog background black click
  $(".btn-close, .box-dialog").click(function() {
    $(".box-dialog" ).hide(500);
    $("body").css({'overflow': 'auto', 'margin-right': 0});
    $(".box-news-content").html('');
  });

  //esc close
  $('body').keyup(function(e){
    if(e.keyCode == 27){
        $(".btn-close").click();
    }
  });
  //load news
});
</script>
</body>
</html>