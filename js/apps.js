var serviceURL = 'http://localhost/miz_planner/apps_auto/';

$( function() {

	initAddAppPopup();

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

			$('#client-autocomplete-dropdown').find('.autocomplete-result').remove();
			$('#submit-form').prop('disabled', true);
		}
	});
}

function initDatepickers() {

	var dateInput = $('input[name=new-app-date]');

	dateInput.datepicker({

		format: 'yyyy-mm-dd',
		autoclose: true

	}).on('changeDate', function() {

		var startTimeInput = $('input[name=new-app-start]');

		startTimeInput.datetimepicker({

			format: 'hh:ii',
			autoclose: true,
			initialDate: new Date(dateInput.val()),
			startView: 1,
			hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23]

		}).on('changeDate', function() {

			var hours = [];
			var maxHour = startTimeInput.val().split(':')[0];

			for(var i = 0; i < maxHour; i++)
				hours.push(i);

			for(var i = 20; i <= 23; i++)
				hours.push(i);

			$('input[name=new-app-end]').datetimepicker({

				format: 'hh:ii',
				autoclose: true,
				initialDate: new Date(dateInput.val()),
				startView: 1,
				hoursDisabled: hours

			});
		});
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
