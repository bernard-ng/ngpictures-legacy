jQuery(function($){

	var alert = $('#flash');
	if(alert.length > 0 )
	{
		alert.hide().slideDown(500).delay(1000).slideUp();
	}

});