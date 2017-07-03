<?php
class AppsView extends AbstractView {

	public function display($template) {

		$this->addStyles(array(
			'css/main.css',
			'css/sticky.css',
			'css/apps.css'
		));

		$this->addExternalScripts(array(
			'js/apps.js'
		));

		$this->appFacade->assignSmartyVariable('weekdays', $this->assignedVariables->weekdays);
		$this->appFacade->assignSmartyVariable('hours', $this->assignedVariables->hours);
		$this->appFacade->assignSmartyVariable('week', $this->assignedVariables->week);
		$this->appFacade->assignSmartyVariable('apps', $this->parseApps($this->assignedVariables->apps));
		$this->appFacade->assignSmartyVariable('thisWeek', $this->assignedVariables->thisWeek);
		$this->appFacade->assignSmartyVariable('app_types', $this->assignedVariables->appTypes);

		if(isset($this->assignedVariables->previousWeek))
			$this->appFacade->assignSmartyVariable('previousWeek', $this->assignedVariables->previousWeek);

		if(isset($this->assignedVariables->nextWeek))
			$this->appFacade->assignSmartyVariable('nextWeek', $this->assignedVariables->nextWeek);

		if(isset($this->assignedVariables->users))
			$this->appFacade->assignSmartyVariable('users', $this->assignedVariables->users);

		if(isset($this->assignedVariables->user_id))
			$this->appFacade->assignSmartyVariable('user_id', $this->assignedVariables->user_id);

		if(isset($this->assignedVariables->menuItems))
			$this->appFacade->assignSmartyVariable('menuItems', $this->assignedVariables->menuItems);

		parent::display($template);
	}

	private function parseApps($apps) {

		foreach($apps as $key => $app)
			$apps[$key]['buttonClass'] = $this->getHTMLClassByStatus($app['status']);

		return $apps;
	}

	private function getHTMLClassByStatus($status) {

		switch($status) {
			case 'done':
				return 'success';
			case 'cancelled':
				return 'warning';
			default:
				return 'info';
		}

		return 'info';
	}
}