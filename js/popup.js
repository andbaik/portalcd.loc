$(document).ready(function($) {
	$('.popup-open').click(function() {
		var idevent = $(this).attr("eventid");
		console.log(idevent);
		$('.popup-fade').fadeIn();
		return false;
	});	
	
	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
		return false;
	});		

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
		}
	});
	
	$('.popup-fade').click(function(e) {
		if ($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();					
		}
	});	
});

$(document).ready(function($) {
	$('.popup-open-date').click(function() {
		var idevent = $(this).attr("eventid");
		console.log(idevent);
		$('.popup-fade-date').fadeIn();
		return false;
	});	
	
	$('.popup-close-date').click(function() {
		$(this).parents('.popup-fade-date').fadeOut();
		return false;
	});		

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade-date').fadeOut();
		}
	});
	
	$('.popup-fade-date').click(function(e) {
		if ($(e.target).closest('.popup-date').length == 0) {
			$(this).fadeOut();					
		}
	});	
});