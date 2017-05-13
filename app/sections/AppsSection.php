<?php
class AppsSection extends AbstractAuthSection {

	public function runGetMethod($params) {
		session_start();

		if(!$this->userIsLoggedIn()) {
			header('Location: ' . $this->appFacade->getAppURL());
		} else {
			//echo date('M d', strtotime('2017W01')) . ' - ';
			//echo date('M d', strtotime('sunday', strtotime('2017W01')));die;
			$currentWeek = $maxWeek = date('W');
			if(isset($params['week'])) {
				$currentWeek = $params['week'];
			}

			$weekdays = $this->getWeekdays($currentWeek);
			$hours = $this->getHours(8, 19);

			$this->view->assign('weekdays', $weekdays);
			$this->view->assign('hours', $hours);
			$this->view->assign('week', $currentWeek);

			if($currentWeek > 1) {
				$this->view->assign('previousWeek', $currentWeek - 1);
			}

			if($currentWeek < $maxWeek) {
				$this->view->assign('nextWeek', $currentWeek + 1);
			}

			$this->view->display('apps');
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