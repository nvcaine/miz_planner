<?php
class IndexView extends AbstractView {

	public function display($template) {

		/*$this->addExternalScripts(array(
			'js/sections/index.js'
		));*/

		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css'//,
			//'css/index.css'
		));

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		if(isset($this->assignedVariables->activeLogin))
			$this->appFacade->assignSmartyVariable('activeLogin', $this->assignedVariables->activeLogin);

		parent::display($template);
	}
}