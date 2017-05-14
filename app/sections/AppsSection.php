<?php
class AppsSection extends AbstractMenuSection {

	public function runGetMethod($params) {
		session_start();

		if(!$this->userIsLoggedIn()) {
			header('Location: ' . $this->appFacade->getAppURL());
		} else {
			$this->showView($params);
		}
	}

	public function runPostMethod($params) {
		session_start();

		if(!$this->userIsLoggedIn()) {

			header('Location: ' . $this->appFacade->getAppURL());

		} else {

			$existingApps = json_decode(file_get_contents('json/apps.json'));

			if(isset($params['edit-app-action'])) {
				foreach($existingApps as $key => $app)
					if($app->id == $params['edit-app-id']) {
						$existingApps[$key]->status = $params['edit-app-status'];
						break;
					}

			} else {

				$existingApps[] = array(
					'id' => time(),
					'hour' => $params['new-app-hour'],
					'day' => $params['new-app-day'],
					'client' => $params['new-app-client'],
					'status' => 'new'
				);
			}

			file_put_contents('json/apps.json', json_encode($existingApps, JSON_PRETTY_PRINT));

			$this->showView($params);
		}
	}

	private function showView($params) {
		$this->init();
		$this->assignSmartyVariables($this->getWeekParam($params), 8, 19);
		$this->view->display('apps');
	}

	private function getWeekParam($params) {

		if(isset($params['week'])) {
			return $params['week'];
		}

		return date('W');
	}

	private function assignSmartyVariables($currentWeek, $startHour, $endHour) {

		$maxWeek = date('W');

		$this->view->assign('week', $currentWeek);
		$this->view->assign('weekdays', $this->getWeekdays($currentWeek));
		$this->view->assign('hours', $this->getHours($startHour, $endHour));

		if($currentWeek > 1) {
			$this->view->assign('previousWeek', $currentWeek - 1);
		}

		if($currentWeek < $maxWeek) {
			$this->view->assign('nextWeek', $currentWeek + 1);
		}

		$this->view->assign('apps', $this->getAppointments());
	}

	private function getWeekdays($week) {

		$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');
		$result = array();

		if($week <= 9) {
			$week = '0' . $week;
		}

		foreach($days as $day) {
			$result[] = date('D M d', strtotime($day, strtotime('2017W' . $week)));
		}

		return $result;
	}

	private function getHours($start, $end) {

		$result = array();

		for($i = $start; $i <= $end; $i++) {
			$result[] = $i . ':00';
			$result[] = $i . ':30';
		}

		return $result;
	}

	private function getAppointments() {
		return json_decode(file_get_contents('json/apps.json'));
	}
}