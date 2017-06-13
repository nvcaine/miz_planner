var serviceURL = 'http://localhost/miz_planner/apps_auto/';

$( function() {

	initAddAppPopup();
	initEditAppPopup();

	initClientsAutocompleteDropdown(500);

	initDatepickers();

	$('.app-type-option').click( function() {
		$('input[name=new-app-type]').val($(this).text());
		$('#app-type-dropdown').dropdown('toggle');
		return false;
	});
});

function initAddAppPopup() {

	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		if($(event.target).is('#add-appointment-popup')) {
	
			$(this).find('input[name=new-app-client]').val('');
			$(this).find('input[name=new-app-type]').val('');
			$(this).find('input[name=new-app-date]').val('');
			$(this).find('input[name=new-app-start]').val('');
			$(this).find('input[name=new-app-end]').val('');
			$(this).find('textarea[name=new-app-notes]').val('');

			$('#client-autocomplete-dropdown').find('.autocomplete-result').remove();
			$('#submit-form').prop('disabled', true);
		}
	});
}

function initEditAppPopup() {
	$('#add-appointment-popup').on('show.bs.modal', function(event) {

		var relTarget = $(event.relatedTarget);

		if(relTarget.is('#edit-app-button')) {

			$(this).find('input[name=new-app-client]').val(relTarget.data('appclient'));
			$(this).find('input[name=new-app-type]').val(relTarget.data('apptype'));
			$(this).find('input[name=new-app-date]').val(relTarget.data('appdate'));
			$(this).find('input[name=new-app-start]').val(relTarget.data('appstart'));
			$(this).find('input[name=new-app-end]').val(relTarget.data('append'));
			$(this).find('textarea[name=new-app-notes]').val(relTarget.data('appnotes'));
			$(this).find('input[name=new-app-client-id]').val(relTarget.data('appclientid'));
			$(this).find('input[name=edit-app-id]').val(relTarget.data('appid'));
			$('#submit-form').attr('value', 'edit-app-action');
			$('#submit-form').prop('disabled', false);
		}
	});

	$('#add-appointment-popup').on('shown.bs.modal', function(event) {

		var relTarget = $(event.relatedTarget);

		if(relTarget.is('#edit-app-button')) {

			var dateInput = $('input[name=new-app-date]');
			dateInput.trigger('changeDate', new Date(dateInput.val()));
		}
	});
}

function initDatepickers() {

	var initialized = false;
	var dateInput = $('input[name=new-app-date]');

	dateInput.datepicker({

		format: 'yyyy-mm-dd',
		autoclose: true,
		daysOfWeekDisabled: [0, 6]

	}).on('changeDate', function(event, date) {

		if(!initialized) {
			var startTimeInput = $('input[name=new-app-start]');

			startTimeInput.datetimepicker({

				format: 'hh:ii',
				autoclose: true,
				initialDate: event.date,
				startView: 1,
				hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]

			});

			$('input[name=new-app-end]').datetimepicker({

				format: 'hh:ii',
				autoclose: true,
				initialDate: event.date,
				startView: 1,
				hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]
			});

			startTimeInput.on('changeDate', function(event) {
				var hours = [];
				var maxHour = startTimeInput.val().split(':')[0];

				for(var i = 0; i < maxHour; i++)
					hours.push(i);

				for(var i = 20; i <= 23; i++)
					hours.push(i);

				$('input[name=new-app-end]').datetimepicker('setHoursDisabled', hours);
			});

			initialized = true;

		} else {

			var startInput = $('input[name=new-app-start]');
			var endInput = $('input[name=new-app-end]');

			var selectedDate = ((date!==undefined) ? date : event.date);

			var startDate = selectedDate;
			if(startInput.val() != '') {
				var startHours = startInput.val().split(':');
				startDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate(), startHours[0], startHours[1]);
				startInput.datetimepicker('update', startDate);
			} else {
				startInput.datetimepicker('setInitialDate', selectedDate);
			}

			var endDate = selectedDate;
			if(endInput.val() != '') {
				var endHours = endInput.val().split(':');
				endDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate(), endHours[0], endHours[1]);
				endInput.datetimepicker('update', endDate);
			} else {
				endInput.datetimepicker('setInitialDate', selectedDate);
			}
		}
	});
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
		$('#submit-form').prop('disabled', false);
		return false;
	});
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
