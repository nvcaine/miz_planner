<div class="modal fade" id="add-appointment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add appointment</h4>
				<div class="modal-body">
					<p>Hour: <span id="app-hour-label"></span></p>
					<p>Day: <span id="app-day-label"></span></p>
					<p>
						<form method="post">
							<div class="form-group">
								<input name="new-app-client" type="text" class="form-control validate" placeholder="Client name" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Save</button>
							</div>
							<input type="hidden" name="new-app-hour">
							<input type="hidden" name="new-app-day">
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
</div>