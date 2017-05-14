$( function() {

	var appTarget;

	$('#add-appointment-popup').on('show.bs.modal', function(event) {
		var target = $(event.relatedTarget);
		var hour = target.data('hour');
		var day = target.data('day');
		$(this).find('#app-hour-label').html(hour);
		$(this).find('#app-day-label').html(day);
		$(this).find('input[name=new-app-hour]').val(hour);
		$(this).find('input[name=new-app-day]').val(day);
	});

	$('#edit-appointment-popup').on('show.bs.modal', function(event) {
		var target = appTarget;
		var status = target.data('status');
		var app_id = target.data('appid');
		var hour = target.parent().data('hour');
		var day = target.parent().data('day');
		var client = appTarget.html();

		$(this).find('#app-status-label').html(status);
		$(this).find('#edit-app-client-label').html(client);
		$(this).find('#edit-app-hour-label').html(hour);
		$(this).find('#edit-app-day-label').html(day);

		$(this).find('input[name=edit-app-id]').val(app_id);
		$(this).find('input[name=edit-app-status]').val(status);
		$(this).find('#app-status-list').attr('class', 'btn ' + getButtonClassByStatus(status) + ' dropdown-toggle');
	});

	$('.app-item-inner').click( function(event) {
		event.stopPropagation();
		appTarget = $(this);
		$('#edit-appointment-popup').modal('toggle');
	});

	$('.edit-status-option').click( function() {
		var status = $(this).data('status');
		$('#edit-appointment-popup').find('#app-status-label').html(status);
		$('#edit-appointment-popup').find('input[name=edit-app-status]').val(status);
		$('#edit-appointment-popup').find('#app-status-list').attr('class', 'btn ' + getButtonClassByStatus(status) + ' dropdown-toggle')
	});
});

function getButtonClassByStatus(status) {

	var buttonStatusClass = 'btn-info';

	if(status == 'done')
		buttonStatusClass = 'btn-success';
	else if(status == 'canceled')
		buttonStatusClass = 'btn-warning';

	return buttonStatusClass;
}