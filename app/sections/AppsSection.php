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

			if(isset($params['edit-app-action']))
				$this->updateApp($params);
			else if(isset($params['delete-app-action']))
				$this->deleteApp($params);
			else
				$this->addApp($params);

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

		$maxWeek = $this->getMaxWeek();

		$this->view->assign('week', $currentWeek);
		$this->view->assign('weekdays', $this->getWeekdays($currentWeek));
		$this->view->assign('hours', $this->getHours($startHour, $endHour));
		$this->view->assign('thisWeek', date('W'));

		if($currentWeek > 1) {
			$this->view->assign('previousWeek', $currentWeek - 1);
		}

		if($currentWeek < $maxWeek) {
			$this->view->assign('nextWeek', $currentWeek + 1);
		}

		$this->view->assign('apps', $this->getAppointments($currentWeek));
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
			$hour = $i;
			if($i < 10)
				$hour = '0' . $i;

			$result[] = $hour . ':00';
			$result[] = $hour . ':30';
		}

		return $result;
	}

	private function getAppointments($week) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		return $proxy->getAppointmentsForWeek($week);
	}

	private function getMaxWeek() {
		return (strtotime('2017W53') !== false) ? 53 : 52;
	}

	private function addApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->addApp($params['new-app-client-id'], $params['new-app-day'], $params['new-app-hour']);
	}

	private function deleteApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->deleteApp($params['edit-app-id']);
	}

	private function updateApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->updateApp($params['edit-app-id'], $params['edit-app-status']);
	}
}