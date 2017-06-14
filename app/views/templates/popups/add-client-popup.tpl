<div class="modal fade" id="add-client-popup" tabindex="-1" role="dialog" aria-labelledby="add-client-popup-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="add-client-popup-label">Add client</h4>
			</div>
			<div class="modal-body">
				<p>
					<form method="post">
						<div class="form-group-lg">
							<input name="new-client-first-name" type="text" class="form-control validate" placeholder="First name *" required>
						</div>
						<div class="form-group-lg">
							<input name="new-client-last-name" type="text" class="form-control validate" placeholder="Last name *" required>
						</div>
						<div class="form-group-lg">
							<input name="new-client-birthday" type="text" class="form-control validate" placeholder="Birthdate *">
						</div>
						<div class="form-group-lg">
							<input name="new-client-address" type="text" class="form-control validate" placeholder="Street number code city country">
						</div>
						<div class="form-group-lg">
							<input name="new-client-phone" type="text" class="form-control validate" placeholder="Phone number">
						</div>
						<div class="form-group-lg">
							<input name="new-client-email" type="text" class="form-control validate" placeholder="E-mail">
						</div>
						<p><br />* Required</p>

						<div class="form-group">
							<button type="submit" class="btn btn-success" name="new-client-add-action">Save</button>
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