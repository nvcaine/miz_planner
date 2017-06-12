<div class="modal fade" id="add-appointment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add appointment</h4>
				<div class="modal-body">
					<p>
						<form method="post">
							<div class="form-group">
								<div id="client-dropdown-wrapper" class="dropdown">
									<input name="new-app-client" type="text" class="form-control validate" placeholder="Client name" required autocomplete="off" data-toggle="dropdown">
									<ul id="client-autocomplete-dropdown" class="dropdown-menu" style="width:100%;">
										<li style="padding-right:10px;">
											<button type="button" class="close" data-toggle="dropdown">
												<span aria-hidden="true">&times;</span>
											</button>
										</li>
									</ul>
								</div>
							</div>

							<div class="form-group">
								<div class="dropdown">
									<input name="new-app-type" type="text" class="form-control" placeholder="Select type" data-toggle="dropdown" readonly>
									<ul id="app-type-dropdown" class="dropdown-menu" style="width:100%;">
										{foreach from=$app_types item=type}
										<li class="dropdown-header" style="background-color:{$type->color};color:white;font-weight:bold;">
											{$type->category}
										</li>
											{foreach from=$type->options item=option}
											<li>
												<a href="#" class="app-type-option">{$option->name}</a>
											</li>
											{/foreach}
										{/foreach}
									</ul>
								</div>
							</div>

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
								<textarea class="form-control" name="new-app-notes" placeholder="Notes" rows="5"></textarea>
							</div>

							<div class="form-group">
								<button id="submit-form" type="submit" class="btn btn-success" disabled>Save</button>
							</div>
							<input type="hidden" name="new-app-client-id" value="-1">
							<input type="hidden" name="week" value="{$week}">
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