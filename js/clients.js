$( function() {
	$('input[name=new-client-birthdate]').datepicker({format: 'yyyy.mm.dd'});

	$('#add-client-popup').on('hidden.bs.modal', function(event) {
		$(this).find('input[name=new-client-first-name]').val('');
		$(this).find('input[name=new-client-last-name]').val('');
		$(this).find('input[name=new-client-birthdate]').val('');
		$(this).find('input[name=new-client-phone]').val('');
	});
});