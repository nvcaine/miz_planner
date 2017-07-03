<?php
class UsersView extends AbstractView {

	public function display($template) {
		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css',
			'css/users.css'
		));

		/*$this->addExternalScripts(array(
			'js/apps.js'
		));*/

		if(isset($this->assignedVariables->users))
			$this->appFacade->assignSmartyVariable('users', $this->assignedVariables->users);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		parent::display($template);
	}
}