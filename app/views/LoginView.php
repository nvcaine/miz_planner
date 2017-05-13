<?php
class LoginView extends AbstractView {
	
	public function display($template) {

		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css'
		));

		if(isset($this->assignedVariables->login_failed))
			$this->appFacade->assignSmartyVariable('login_failed', true);
		parent::display($template);
	}
}