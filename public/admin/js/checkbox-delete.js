//delete checkbox
$(document).ready(function() {
	//delete multi one checkbox check all
    $('.parent-checkbox-delete').click(function() {
      $('.checkbox-delete').prop('checked', $(this).is(':checked'));
    });
	var lastChecked = null;
	$('#dataTable').on('click', '.checkbox-delete', function(e) {
	    if(!lastChecked) {
	        lastChecked = this;
	        return;
	    }
	    if(e.shiftKey) {
	        var start = $('.checkbox-delete').index(this);
	        var end = $('.checkbox-delete').index(lastChecked);
	        $('.checkbox-delete').slice(Math.min(start,end), Math.max(start,end)+ 1).prop('checked', lastChecked.checked);
	    }
	    lastChecked = this;
	});
});