$( function() {
	$('#add-appointment-popup').on('show.bs.modal', function(event) {
		var target = $(event.relatedTarget);
		$(this).find('#app-hour-label').html(target.data('hour'));
		$(this).find('#app-day-label').html(target.data('day'));
	});
});