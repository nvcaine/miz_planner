<?php
class AppsSection extends AbstractMenuSection {

	public function runGetMethod($params) {

		session_start();

		if(!$this->userIsLoggedIn()) {
			$peristent = $this->checkPersistentLogin();
	
			if(!$peristent)
				header('Location: ' . $this->appFacade->getAppURL());
		}

		$this->showView($params);
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
		$this->assignSmartyVariables($params, 8, 20);
		$this->view->display('apps');
	}

	private function getWeekParam($params) {

		if(isset($params['week'])) {
			return $params['week'];
		}

		return date('W');
	}

	private function assignSmartyVariables($params, $startHour, $endHour) {

		$maxWeek = $this->getMaxWeek();
		$currentWeek = $this->getWeekParam($params);

		$this->view->assign('week', $currentWeek);
		$this->view->assign('weekdays', $this->getWeekdays($currentWeek));
		$this->view->assign('hours', $this->getHours($startHour, $endHour));
		$this->view->assign('thisWeek', date('W'));
		$this->view->assign('appTypes', json_decode(file_get_contents('json/types.json')));

		if($currentWeek > 1) {
			$this->view->assign('previousWeek', $currentWeek - 1);
		}

		if($currentWeek < $maxWeek) {
			$this->view->assign('nextWeek', $currentWeek + 1);
		}

		$userId = $_SESSION[Consts::USERID_INDEX];

		$usersProxy = new UsersProxy(DBWrapper::cloneInstance());
		$users = $usersProxy->getAllUsers();
		foreach($users as $key => $user)
			if($user['user_id'] == $userId)
				$users[$key]['current_user'] = true; // to avoid redundant params in dropdown links

		$this->view->assign('users', $users);

		if(isset($params['user_id'])) {
			$userId = $params['user_id'];
			$this->view->assign('user_id', $userId);
		}

		$this->view->assign('assign_to_user_id', $userId);
		$this->view->assign('apps', $this->getAppointments($currentWeek, $userId));
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

			if($i < $end)
				$result[] = $hour . ':30';
		}

		return $result;
	}

	private function getAppointments($week, $userId = -1) {

		$types = json_decode(file_get_contents('json/types.json'));
		$proxy = new AppsProxy(DBWrapper::cloneInstance());

		if($userId != -1)
			$apps = $proxy->getAppointmentsForWeekByUser($week, $userId);
		else
			$apps = $proxy->getAppointmentsForWeekByUser($week, $_SESSION[Consts::USERID_INDEX]);

		foreach($apps as $key => $app)
			$apps[$key]['event_type'] = $this->getAppEventType($types, $app['type']);

		return $apps;
	}

	private function getMaxWeek() {
		$year = date('Y');
		return (strtotime($year . 'W53') !== false) ? 53 : 52;
	}

	private function addApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->addApp(
			$params['new-app-client-id'],
			$params['new-app-date'],
			$params['new-app-start'],
			$params['new-app-end'],
			$params['new-app-type'],
			$params['new-app-notes']
		);

		$this->addUserApp($proxy->getLastInsertId(), $params['assigned_user_id']);

	}

	private function addUserApp($app_id, $userId) {
		$proxy = new UserappsProxy(DBWrapper::cloneInstance());
		$proxy->addUserApp($app_id, $userId, $_SESSION[Consts::USERID_INDEX]);
	}

	private function deleteApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->deleteApp($params['edit-app-id']);

		$userAppsProxy = new UserappsProxy(DBWrapper::cloneInstance());
		$userAppsProxy->deleteUserApp($params['edit-app-id']);
	}

	private function updateApp($params) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$proxy->updateApp($params);

		$userAppsProxy = new UserappsProxy(DBWrapper::cloneInstance());
		$userAppsProxy->updateUserApp($params['edit-app-id'], $params['assigned_user_id']);
	}

	private function getAppEventType($types, $appType) {

		foreach($types as $type)
			foreach($type->options as $option)
				if($option->name == $appType)
					return $type->code;

		return 0;
	}
}