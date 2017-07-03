<div class="modal fade" id="edit-user-popup" tabindex="-1" role="dialog" aria-labelledby="edit-user-popup-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="edit-user-popup-label">Edit user</h4>
			</div>
			<div class="modal-body">
				<p>
					<form method="post">
						<div class="form-group-lg">
							<input name="edit-user-name" type="text" class="form-control validate" placeholder="Full name *" required>
						</div>

						<div class="form-group-lg">
							<input name="edit-user-email" type="text" class="form-control validate" placeholder="E-mail address *" required>
						</div>

						<div class="form-group-lg">
							<input name="edit-user-password" type="text" class="form-control validate" placeholder="Password" >
						</div>

						<p><br />* Required</p>

						<div class="form-group">
							<button type="submit" class="btn btn-success" name="user-edit-action">Save</button>
							<button type="submit" class="btn btn-danger" name="user-delete-action" onclick="return confirm('Are you sure you want to delete this user ?');">
								<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete
							</button>
						</div>
						<input type="hidden" name="edit-user-id">
					</form>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>