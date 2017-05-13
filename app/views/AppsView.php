<?php
class AppsView extends AbstractView {

	public function display($template) {

		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css',
			'css/apps.css'
		));

		$this->appFacade->assignSmartyVariable('weekdays', $this->assignedVariables->weekdays);
		$this->appFacade->assignSmartyVariable('hours', $this->assignedVariables->hours);
		$this->appFacade->assignSmartyVariable('week', $this->assignedVariables->week);

		if(isset($this->assignedVariables->previousWeek))
			$this->appFacade->assignSmartyVariable('previousWeek', $this->assignedVariables->previousWeek);

		if(isset($this->assignedVariables->nextWeek))
			$this->appFacade->assignSmartyVariable('nextWeek', $this->assignedVariables->nextWeek);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		parent::display($template);
	}
}