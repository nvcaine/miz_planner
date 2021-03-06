<?php
class UsersView extends AbstractView {

	public function display($template) {
		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css',
			'css/users.css'
		));

		$this->addExternalScripts(array(
			'js/users.js'
		));

		if(isset($this->assignedVariables->users))
			$this->appFacade->assignSmartyVariable('users', $this->assignedVariables->users);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		if(isset($this->assignedVariables->activeLogin))
			$this->appFacade->assignSmartyVariable('activeLogin', $this->assignedVariables->activeLogin);

		parent::display($template);
	}
}