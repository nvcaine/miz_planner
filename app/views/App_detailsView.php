<?php
class App_detailsView extends AbstractView {

	public function display($template) {
		$this->appFacade->assignSmartyVariable('app', $this->assignedVariables->app);
		$this->appFacade->assignSmartyVariable('week', $this->assignedVariables->week);

		parent::display($template);
	}
}