$('#exampleAccordion').find('.nav-link').each(function() {
	var href = $(this).attr('href');
	var currentHref = window.location.href;
	var check = 0;
	var indexCheckShow = 0;
	for (var i = currentHref.length; i >= 0; i--) {
		if( currentHref[i] == '/') {
			if (currentHref.indexOf('/create', i) >= 0) {
				//is create
				currentHref = currentHref.substr(0, i);
				break;
			} else if (currentHref.indexOf('/edit', i) == -1) {
				//is index
				indexCheckShow = i;
				break;
			}
			check++;
		}
		if (check == 2) {
			//is edit
			currentHref = currentHref.substr(0, i);
			break;
		}
	}
	if (href == currentHref) {
		$(this).parent().addClass('active');
		return false;
	} else if (href == currentHref.substr(0, indexCheckShow)) {
		$(this).parent().addClass('active');
		return false;
	}
});