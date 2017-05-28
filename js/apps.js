var autocompleteTimer;
var serviceURL = 'http://localhost/miz_planner/apps_auto/';

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
		$(this).find('input[name=new-app-client]').val('');
		$('#client-autocomplete-dropdown').find('.autocomplete-result').remove();
		$('#submit-form').prop('disabled', true);
	});

	$('#edit-appointment-popup').on('show.bs.modal', function(event) {
		var target = appTarget;
		var status = target.data('status');
		var app_id = target.data('appid');
		var hour = target.parent().data('hour');
		var day = target.parent().data('day');
		var client = target.data('fullname');

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

	$('input[name=new-app-client]').on('keyup', function(event) {
		if(event.which == 13) {
			console.log('submit');
		}

		if(autocompleteTimer !== null) {
			autocompleteTimer = clearTimeout(autocompleteTimer);
		}

		autocompleteTimer = setTimeout(getAutocompleteResults, 500);
	});

	$('#client-autocomplete-dropdown').on('click', '.client-autocomplete-link', function() {
		$('input[name=new-app-client]').val($(this).text());
		$('input[name=new-app-client-id]').val($(this).data('client_id'));
		$('#client-autocomplete-dropdown').dropdown('toggle');
		$('#submit-form').prop('disabled', false);
		return false;
	});
});

function getButtonClassByStatus(status) {

	var buttonStatusClass = 'btn-info';

	if(status == 'done')
		buttonStatusClass = 'btn-success';
	else if(status == 'cancelled')
		buttonStatusClass = 'btn-warning';

	return buttonStatusClass;
}

function getAutocompleteResults() {

	var dropdown = $('#client-autocomplete-dropdown');
	dropdown.find('.autocomplete-result').remove();


	var newClientId = Math.round(new Date().getTime() / 1000);
	$('input[name=new-app-client-id]').val(newClientId);

	var query = $('input[name=new-app-client]').val();

	$.get(serviceURL, {query: query}, function(data) {
		if(data !== undefined && data !== null && data.length > 0) {
			$.each(data, function(index, item) {
				var htmlElement = $('<li class="autocomplete-result"></li>');
				var fullName = item.first_name + ' ' + item.last_name;
				htmlElement.html(
					'<a href="#" class="client-autocomplete-link" data-client_id="' + item.client_id + '">' +
						getHighightedAutocompleteLabel(fullName, query) +
					'</a>'
				);
				dropdown.append(htmlElement);
			});
		}
	});
}

function getHighightedAutocompleteLabel(name, query) {

	var startIndex = name.toLowerCase().indexOf(query.toLowerCase());

	return name.substring(0, startIndex) +
		'<strong>' + name.substring(startIndex, startIndex + query.length) + '</strong>' +
		name.substring(startIndex + query.length);
}