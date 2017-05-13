<?php
class AppsSection extends AbstractMenuSection {

	public function runGetMethod($params) {
		session_start();

		if(!$this->userIsLoggedIn()) {
			header('Location: ' . $this->appFacade->getAppURL());
		} else {
			$this->init();
			$this->assignSmartyVariables($this->getWeekParam($params), 8, 19);
			$this->view->display('apps');
		}
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
}