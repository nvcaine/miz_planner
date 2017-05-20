<?php
class ClientsView extends AbstractView {
	
	public function display($template) {
		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css'
		));

		$this->addExternalScripts(array(
			'js/clients.js'
		));

		$this->appFacade->assignSmartyVariable('clients', $this->assignedVariables->clients);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		parent::display($template);
	}
}