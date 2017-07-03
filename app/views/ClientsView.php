<?php
class ClientsView extends AbstractView {
	
	public function display($template) {
		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css',
			'css/clients.css'
		));

		$this->addExternalScripts(array(
			'js/clients.js'
		));

		$this->appFacade->assignSmartyVariable('clients', $this->assignedVariables->clients);
		$this->appFacade->assignSmartyVariable('clients_birthdays', $this->assignedVariables->clients_birthdays);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		if(isset($this->assignedVariables->activeLogin))
			$this->appFacade->assignSmartyVariable('activeLogin', $this->assignedVariables->activeLogin);

		parent::display($template);
	}
}