<div class="modal fade" id="add-user-popup" tabindex="-1" role="dialog" aria-labelledby="add-user-popup-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="add-user-popup-label">Add user</h4>
			</div>
			<div class="modal-body">
				<p>
					<form method="post">
						<div class="form-group-lg">
							<input name="new-user-name" type="text" class="form-control validate" placeholder="Full name *" required>
						</div>

						<div class="form-group-lg">
							<input name="new-user-email" type="text" class="form-control validate" placeholder="E-mail address *" required>
						</div>

						<div class="form-group-lg">
							<input name="new-user-password" type="text" class="form-control validate" placeholder="Password *" required>
						</div>

						<p><br />* Required</p>

						<div class="form-group">
							<button type="submit" class="btn btn-success" name="new-user-add-action">Save</button>
						</div>
						<!--<input type="hidden" name="new-app-client-id">-->
					</form>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>