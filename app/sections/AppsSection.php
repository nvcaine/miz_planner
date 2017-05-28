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
						if(isset($params['delete-app-action'])) {
							unset($existingApps[$key]);
							$existingApps = array_values($existingApps);
						} else {
							$existingApps[$key]->status = $params['edit-app-status'];
						}
						break;
					}
			} else {

				/*$existingApps[] = array(
					'id' => time(),
					'hour' => $params['new-app-hour'],
					'day' => $params['new-app-day'],
					'client' => intval($params['new-app-client-id']),
					'status' => 'new'
				);*/
				$this->addApp($params);
	
				//$this->checkIfNewClient($params);
			}

			//file_put_contents('json/apps.json', json_encode($existingApps, JSON_PRETTY_PRINT));

			$this->showView($params);
		}
	}

	private function addApp($params) {
		$appsProxy = new AppsProxy(DBWrapper::cloneInstance());
		$appsProxy->addApp($params['new-app-client-id'], $params['new-app-day'], $params['new-app-hour']);
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

		/*$apps = json_decode(file_get_contents('json/apps.json'));
		$clients = json_decode(file_get_contents('json/clients.json'));

		foreach($apps as $index => $app)
			foreach($clients as $client)
				if($client->id == $app->client) {
					$apps[$index]->client = $client->first_name . ' ' . $client->last_name;
					$apps[$index]->client_short = $client->first_name[0] . '. ' . $client->last_name;

				}*/
		$appsProxy = new AppsProxy(DBWrapper::cloneInstance());

		return $appsProxy->getAppointmentsForWeek($week);
	}

	private function getMaxWeek() {
		return (strtotime('2017W53') !== false) ? 53 : 52;
	}

	private function checkIfNewClient($params) {
		$clients = json_decode(file_get_contents('json/clients.json'));

		foreach($clients as $client)
			if($client->id == $params['new-app-client-id'])
				return;

		$names = explode(' ', $params['new-app-client']);

		if(isset($names[0]) && $names[0] != '' && isset($names[1]) && $names[1] != '') {

			$clients[] = array(
				'id' => intval($params['new-app-client-id']),
				'first_name' => ucfirst($names[0]),
				'last_name' => ucfirst($names[1]),
				'date_added' => date('m/d/Y')
			);

			file_put_contents('json/clients.json', json_encode($clients, JSON_PRETTY_PRINT));
		}
	}
}