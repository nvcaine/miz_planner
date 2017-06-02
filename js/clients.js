$( function() {
	$('input[name=new-client-birthday]').datepicker({format: 'yyyy-mm-dd'});

	$('#add-client-popup').on('hidden.bs.modal', function(event) {
		$(this).find('input[name=new-client-first-name]').val('');
		$(this).find('input[name=new-client-last-name]').val('');
		$(this).find('input[name=new-client-birthday]').val('');
		$(this).find('input[name=new-client-phone]').val('');
	});

	$('#edit-client-popup').on('show.bs.modal', function(event) {
		if(event.relatedTarget !== undefined) {
			var button = $(event.relatedTarget);
			$(this).find('input[name=edit-client-id]').val(button.data('client_id'));
			$(this).find('input[name=edit-client-first-name]').val(button.data('client_first'));
			$(this).find('input[name=edit-client-last-name]').val(button.data('client_last'));
			$(this).find('input[name=edit-client-birthday]').val(button.data('client_birthday'));
			$(this).find('input[name=edit-client-address]').val(button.data('client_phone'));
			$(this).find('input[name=edit-client-phone]').val(button.data('client_address'));
			$(this).find('input[name=edit-client-email]').val(button.data('client_email'));
			$('input[name=edit-client-birthday]').datepicker({format: 'yyyy-mm-dd', initialDate: button.data('client_birthday')})
		}
	});
});