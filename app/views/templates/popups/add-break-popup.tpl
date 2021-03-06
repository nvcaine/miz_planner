<div class="modal fade" id="add-break-popup" tabindex="-1" role="dialog" aria-labelledby="break-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="break-modal-label">Add break</h4>
				<div class="modal-body">
					<p>
						<form id="break-form" method="post">
							<div class="form-group">
								<input type="text" class="form-control" name="new-app-date" placeholder="Date" readonly>
							</div>
							<div class="form-group">
								<input type="text" class="form-control form-datetime" name="new-app-start" placeholder="Start time (HH:MM)" readonly>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="new-app-end" placeholder="End time (HH:MM)" readonly>
							</div>

							<div class="form-group">
								<div class="dropdown">
									<input name="new-app-assigned-user" type="text" class="form-control validate" autocomplete="off" required data-toggle="dropdown" placeholder="Assign to" readonly>

									<ul class="users-list dropdown-menu" style="width:100%">
										{foreach from=$users item=user}
										<li>
											<a href="#" class="assign-user-link" data-user_id="{$user.user_id}">{$user.name}</a>
										</li>
										{/foreach}
									</ul>
								</div>
							</div>

							<div class="overlap-app-alert alert alert-danger" role="alert">
								<p>The specified interval overlaps an existing appointment assigned to the selected user:</p>
								<p class="overlap-app-time">[Start time] - [End time]</p>
								<p class="overlap-app-client">Client: [Name], type: [Type]</p>
							</div>

							<div class="form-group">
								<textarea class="form-control" name="new-app-notes" placeholder="Notes" rows="5"></textarea>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-success submit-form-button">Save</button>
							</div>
							<input type="hidden" name="new-app-client-id" value="0">
							<input type="hidden" name="edit-app-id" value="-1">
							<input type="hidden" name="week" value="{$week}">
							<input type="hidden" name="assigned_user_id" value="">

							<input name="new-app-type" type="hidden" value="Break">
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