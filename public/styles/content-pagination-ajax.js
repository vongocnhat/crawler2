$('.contents-ajax').on('click', '.pagination .page-item', function(e) {
	e.preventDefault();
	var searchStr = $('input[name=searchStr]').val();
	var perPage = $('input[name=perPage]').val();
	var url = $(this).find('.page-link').attr('href') + '&searchStr=' + searchStr + '&perPage=' + perPage;
	$.ajax({
		url: url,
		success: function(data) {
         	$('.contents-ajax').html(data);
      	}
	});
});