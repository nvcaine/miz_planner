<div class="modal fade" id="edit-client-popup" tabindex="-1" role="dialog" aria-labelledby="edit-client-popup-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="edit-client-popup-label">Edit client</h4>
			</div>
			<div class="modal-body">
				<p>
					<form method="post">
						<div class="form-group-lg">
							<input name="edit-client-first-name" type="text" class="form-control validate" placeholder="First name">
						</div>
						<div class="form-group-lg">
							<input name="edit-client-last-name" type="text" class="form-control validate" placeholder="Last name *" required>
						</div>
						<div class="form-group-lg">
							<input name="edit-client-birthday" type="text" class="form-control validate" placeholder="Birthdate *" required>
						</div>
						<div class="form-group-lg">
							<input name="edit-client-address" type="text" class="form-control validate" placeholder="Street number code city country">
						</div>
						<div class="form-group-lg">
							<input name="edit-client-phone" type="text" class="form-control validate" placeholder="Phone number">
						</div>
						<div class="form-group-lg">
							<input name="edit-client-email" type="text" class="form-control validate" placeholder="E-mail">
						</div>
						<p><br />* Required</p>

						<div class="form-group">
							<button type="submit" class="btn btn-success" name="edit-client-action">Save</button>
							<button type="submit" class="btn btn-danger" name="delete-client-action" onclick="return confirm('Are you sure you want to delete this client?');">
								<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete
							</button>
						</div>

						<input type="hidden" name="edit-client-id">
					</form>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>