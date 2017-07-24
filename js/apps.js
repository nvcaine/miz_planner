var serviceURL = 'http://localhost/miz_planner/apps_auto/';

$( function() {

	initAddAppPopup();
	initEditAppPopup();

	initClientsAutocompleteDropdown(500);

	// break form doesn't have type - maybe add a readonly; or better - a hidden input
	initForm(
		'#app-form',
		'input[name=new-app-type]',
		'input[name=new-app-date]',
		'input[name=new-app-start]', 
		'input[name=new-app-end]',
		'input[name=new-app-assigned-user]',
		'input[name=assigned_user_id]',
		'.submit-form-button',
		'.overlap-app-alert'
	);

	$('.app-type-option').click( function() {
		$('input[name=new-app-type]').val($(this).text());
		$('#app-type-dropdown').dropdown('toggle');
		return false;
	});
});

function initAddAppPopup() {

	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		$('.overlap-app-alert').hide();

		if($(event.target).is('#add-appointment-popup')) {
	
			$(this).find('input[name=new-app-client]').val('');
			$(this).find('input[name=new-app-type]').val('');
			$(this).find('input[name=new-app-date]').val('');
			$(this).find('input[name=new-app-start]').val('');
			$(this).find('input[name=new-app-end]').val('');
			$(this).find('textarea[name=new-app-notes]').val('');
			$(this).find('input[name=new-app-assigned-user]').val('');

			$('#client-autocomplete-dropdown').find('.autocomplete-result').remove();
		}
	});
}

function initEditAppPopup() {
	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		$('.overlap-app-alert').hide();

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

			var assignedUserName = $('.assign-user-link[data-user_id=' + relTarget.data('userid') + ']').text();
			$(this).find('input[name=new-app-assigned-user]').val(assignedUserName);
			$('input[name=assigned_user_id]').val(relTarget.data('userid'));
			$('.submit-form-button').attr('name', 'edit-app-action');

			var dateObject = new Date(relTarget.data('appdate'));
			updateTimeInput(startInput, getTimeInputDateObject(dateObject, relTarget.data('appstart')));
			updateTimeInput(startInput, getTimeInputDateObject(dateObject, relTarget.data('append')));
		}
	});
}

function initDatepickers(dateInput, startTimeInput, endTimeInput) {

	var timePickerOptions = {
		format: 'hh:ii',
		autoclose: true,
		startView: 1,
		hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]
	};

	dateInput.datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		daysOfWeekDisabled: [0, 6]
	});

	startTimeInput.datetimepicker(timePickerOptions);
	endTimeInput.datetimepicker(timePickerOptions);

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
		$('.overlap-app-alert').hide();
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

function initForm(formSelector, typeSelector, dateSelector, startSelector, endSelector, userSelector, userIdSelector, submitSelector, alertSelector) {

	var selectors = [typeSelector, dateSelector, startSelector, endSelector, userSelector];

	initDatepickers(
		$(dateSelector),
		$(startSelector),
		$(endSelector)
	);

	initOverlapValidation(
		dateSelector,
		startSelector, 
		endSelector,
		userIdSelector,
		userSelector,
		submitSelector,
		alertSelector
	);

	$(formSelector).submit( function() {

		for(i = 0; i < selectors.length; i++) {
			var element = $(this).find(selectors[i]);
			var elementValue = element.val();
			if(elementValue === undefined || elementValue == '') {
				element.focus().trigger('click');
				return false;
			}
		}

		return true;
	});
}

function initOverlapValidation(dateSelector, startSelector, endSelector, userIdSelector, userNameSelector, submitSelector, alertSelector) {

	var dateSelectors = [];

	$(dateSelector + ',' + startSelector + ',' + endSelector).on('changeDate', function() {
		validateAppOverlapping(
			$(dateSelector).val(),
			$(startSelector).val(),
			$(endSelector).val(),
			$(userIdSelector).val(),
			submitSelector,
			alertSelector

		);
	});

	var dropdown = $('.users-list');

	dropdown.on('click', '.assign-user-link', function() {
		$(userIdSelector).val($(this).data('user_id'));

		$(userNameSelector).val($(this).text());

		dropdown.dropdown('toggle');
		validateAppOverlapping(
			$(dateSelector).val(),
			$(startSelector).val(),
			$(endSelector).val(),
			$(userIdSelector).val(),
			submitSelector,
			alertSelector
		);
		return false;
	});
}

function validateAppOverlapping(date, start, end, assignedTo, submitButtonSelector, alertSelector) {
	var alert = $(alertSelector);

	alert.hide();

	if(date !== undefined && date != '' &&
		start !== undefined && start != '' &&
		end !== undefined && end != '' &&
		assignedTo !== undefined && assignedTo != '') {

		var requestData = {
			request: 'validate_interval',
			date: date,
			start: start,
			end: end,
			user_id: assignedTo};

		$.get(serviceURL, requestData, function(data) {
			var submitEnabled = true;

			if(data.hasOwnProperty('result') && data.result == 'valid')
				submitEnabled = false;
			else
				showOverlappingAlert(data, alert);

			$(submitButtonSelector).prop('disabled', submitEnabled);
		});
	}	
}

function showOverlappingAlert(data, alert) {
	alert.find('.overlap-app-time').html(data.app.start_time + ' - ' + data.app.end_time);
	alert.find('.overlap-app-client').html(data.app.first_name + ' ' + data.app.last_name + ' - ' + data.app.type);
	alert.show();
}