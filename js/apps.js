var serviceURL = 'http://localhost/miz_planner/apps_auto/';

$( function() {

	initAddAppPopup();
	initEditAppPopup();

	initClientsAutocompleteDropdown(500);
	initUsersDropdown();
	initDatepickers();

	initForm();
	initDateValidation();

	$('.app-type-option').click( function() {
		$('input[name=new-app-type]').val($(this).text());
		$('#app-type-dropdown').dropdown('toggle');
		return false;
	});
});

function initAddAppPopup() {

	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		$('#overlap-app-alert').hide();

		if($(event.target).is('#add-appointment-popup')) {
	
			$(this).find('input[name=new-app-client]').val('');
			$(this).find('input[name=new-app-type]').val('');
			$(this).find('input[name=new-app-date]').val('');
			$(this).find('input[name=new-app-start]').val('');
			$(this).find('input[name=new-app-end]').val('');
			$(this).find('textarea[name=new-app-notes]').val('');
			$(this).find('#assigned-user').val('');

			$('#client-autocomplete-dropdown').find('.autocomplete-result').remove();
			//$('#submit-form').prop('disabled', true);
		}
	});
}

function initEditAppPopup() {
	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		$('#overlap-app-alert').hide();

		var relTarget = $(event.relatedTarget);

		if(relTarget.is('#edit-app-button')) {

			var startInput = $(this).find('input[name=new-app-start]');
			var endInput = $(this).find('input[name=new-app-end]');

			$(this).find('input[name=new-app-client]').val(relTarget.data('appclient'));
			$(this).find('input[name=new-app-type]').val(relTarget.data('apptype'));
			$(this).find('input[name=new-app-date]').val(relTarget.data('appdate'));
			startInput.val(relTarget.data('appstart'));
			endInput.val(relTarget.data('append'));
			$(this).find('textarea[name=new-app-notes]').val(relTarget.data('appnotes'));
			$(this).find('input[name=new-app-client-id]').val(relTarget.data('appclientid'));
			$(this).find('input[name=edit-app-id]').val(relTarget.data('appid'));
			$('#submit-form').attr('name', 'edit-app-action');
			//$('#submit-form').prop('disabled', false);

			// !! set assigned user

			var dateObject = new Date(relTarget.data('appdate'));
			updateTimeInput(startInput, getTimeInputDateObject(dateObject, relTarget.data('appstart')));
			updateTimeInput(startInput, getTimeInputDateObject(dateObject, relTarget.data('append')));
		}
	});
}

function initDatepickers() {

	var dateInput = $('input[name=new-app-date]');
	var startTimeInput = $('input[name=new-app-start]');
	var endTimeInput = $('input[name=new-app-end]');

	dateInput.datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		daysOfWeekDisabled: [0, 6]

	});

	startTimeInput.datetimepicker({
		format: 'hh:ii',
		autoclose: true,
		startView: 1,
		hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]
	});

	endTimeInput.datetimepicker({
		format: 'hh:ii',
		autoclose: true,
		startView: 1,
		hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]
	});

	dateInput.on('changeDate', function(event) {
		updateTimeInput(startTimeInput, event.date);
		updateTimeInput(endTimeInput, event.date);
	});

	startTimeInput.on('changeDate', function(event) {
		var hours = [];
 		var maxHour = startTimeInput.val().split(':')[0];

		for(var i = 0; i < maxHour; i++)
			hours.push(i);
		for(var i = 20; i <= 23; i++)
 			hours.push(i);

 		endTimeInput.datetimepicker('setHoursDisabled', hours);
 		endTimeInput.datetimepicker('update', event.date);
 		endTimeInput.val('');
		$('#overlap-app-alert').hide();
	});
}

function updateTimeInput(element, date) {

	var elementValue = element.val();
	var method = 'setInitialDate';
	var param = date;

	if(elementValue != '') {
		method = 'update';
		param = getTimeInputDateObject(date, elementValue);
	}

	element.datetimepicker(method, param);
}

function getTimeInputDateObject(date, time) {

	var startHours = time.split(':');

	return new Date(
		date.getFullYear(),
		date.getMonth(),
		date.getDate(),
		startHours[0],
		startHours[1]
	);	
}

function initClientsAutocompleteDropdown(autocompleteRequestDelay) {

	var autocompleteTimer;

	$('input[name=new-app-client]').on('keyup', function(event) {

		if(autocompleteTimer !== null)
			autocompleteTimer = clearTimeout(autocompleteTimer);

		autocompleteTimer = setTimeout(getAutocompleteResults, autocompleteRequestDelay);
	});

	$('#client-autocomplete-dropdown').on('click', '.client-autocomplete-link', function() {
		$('input[name=new-app-client]').val($(this).text());
		$('input[name=new-app-client-id]').val($(this).data('client_id'));
		$('#client-autocomplete-dropdown').dropdown('toggle');
		//$('#submit-form').prop('disabled', false);
		return false;
	});
}

function getAutocompleteResults() {

	var dropdown = $('#client-autocomplete-dropdown');
	dropdown.find('.autocomplete-result').remove();

	var newClientId = Math.round(new Date().getTime() / 1000);
	$('input[name=new-app-client-id]').val(newClientId);

	var query = $('input[name=new-app-client]').val();

	$.get(serviceURL, {request: 'clients_autocomplete', query: query}, function(data) {
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

function initForm() {

	$('#app-form').submit( function() {

		var selectors = [
			'input[name=new-app-type]',
			'input[name=new-app-date]',
			'input[name=new-app-start]', 
			'input[name=new-app-end]',
			'#assigned-user'];

		for(i = 0; i < selectors.length; i++) {		
			var elementValue = $(selectors[i]).val();
			if(elementValue === undefined || elementValue == '') {
				$(selectors[i]).focus().trigger('click');
				return false;
			}
		}

		return true;
	});
}

function initDateValidation() {

	var selector = 'input[name=new-app-date],input[name=new-app-start],input[name=new-app-end]';

	$(selector).on('changeDate', validateAppOverlapping);
}

function validateAppOverlapping() {
	$('#overlap-app-alert').hide();

	date = $('input[name=new-app-date]').val();
	start = $('input[name=new-app-start]').val();
	end = $('input[name=new-app-end]').val();
	assignedTo = $('#assigned-user').val();

	if(date !== undefined && date != '' &&
		start !== undefined && start != '' &&
		end !== undefined && end != '' &&
		assignedTo !== undefined && assignedTo != '') {

		var requestData = {
			request: 'validate_interval',
			date: date,
			start: start,
			end: end,
			user_id: $('input[name=assigned_user_id]').val()};

		$.get(serviceURL, requestData, function(data) {
			if(data.hasOwnProperty('result') && data.result == 'valid')
				$('#submit-form').prop('disabled', false);
			else
				showOverlappingAlert(data);
		});
	}	
}

function showOverlappingAlert(data) {
	var alert = $('#overlap-app-alert');
	alert.find('.overlap-app-time').html(data.app.start_time + ' - ' + data.app.end_time);
	alert.find('.overlap-app-client').html(data.app.first_name + ' ' + data.app.last_name + ' - ' + data.app.type);
	alert.show();
	$('#submit-form').prop('disabled', true);
}

function initUsersDropdown() {

	$.get(serviceURL, {request: 'list_users'}, function(data) {
		var dropdown = $('#users-list');

		$.each(data, function(index, item) {
			var htmlElement = $('<li></li>');
			htmlElement.html(
				'<a href="#" class="assign-user-link" data-user_id="' + item.user_id + '">' +
					item.name +
				'</a>'
			);
			dropdown.append(htmlElement);
		});
	});

	$('#users-list').on('click', '.assign-user-link', function() {
		$('input[name=assigned_user_id]').val($(this).data('user_id'));
		$('#assigned-user').val($(this).text());
		$('#users-list').dropdown('toggle');
		validateAppOverlapping();
		return false;
	});
}