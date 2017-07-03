$( function() {

	initAddPopup();
	initEditPopup();
});

function initAddPopup() {
	$('#add-user-popup').on('hidden.bs.modal', function(event) {
		$(this).find('input[name=new-user-name]').val('');
		$(this).find('input[name=new-user-email]').val('');
		$(this).find('input[name=new-user-password]').val('');
	});
}

function initEditPopup() {
	$('#edit-user-popup').on('show.bs.modal', function(event) {
		if(event.relatedTarget !== undefined) {
			var button = $(event.relatedTarget);
			$(this).find('input[name=edit-user-id]').val(button.data('user_id'));
			$(this).find('input[name=edit-user-name]').val(button.data('user_name'));
			$(this).find('input[name=edit-user-email]').val(button.data('user_email'));
		}
	});
}