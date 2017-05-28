<div class="modal fade" id="edit-appointment-popup" tabindex="-1" role="dialog" aria-labelledby="edit-app-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="edit-app-label">Edit appointment</h4>
				<div class="modal-body">
					<p>Client: <span id="edit-app-client-label"></span></p>
					<p>Hour: <span id="edit-app-hour-label"></span></p>
					<p>Day: <span id="edit-app-day-label"></span></p>
					<p>Update appointment status.</p>
					<form method="post">
						<div class="form-group" style="width:100%;">
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="app-status-list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:100%;">
									<span id="app-status-label"></span>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" style="width:100%;">
									<li>
										<div class="btn btn-info edit-status-option" data-status="new">new</div>
									</li>
									<li>
										<div class="btn btn-success edit-status-option" data-status="done">done</div>
									</li>
									<li>
										<div class="btn btn-warning edit-status-option" data-status="cancelled">cancelled</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" name="edit-app-action" class="btn btn-success">Save</button>
							<input type="submit" class="btn btn-danger" name="delete-app-action" value="Delete" onclick="return confirm('Are you sure you want to delete this appointment?');">
						</div>
						<input type="hidden" name="edit-app-id">
						<input type="hidden" name="edit-app-status">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>