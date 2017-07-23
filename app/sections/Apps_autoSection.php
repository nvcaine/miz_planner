<?php
class Apps_autoSection extends AbstractSection {

	public function runGetMethod($params) {

		header("Content-type: application/json");

		session_start();

		if(isset($_SESSION[Consts::LOGGED_IN_INDEX]) && ($_SESSION[Consts::LOGGED_IN_INDEX] === true))
			$this->handleAsyncRequest($params);
		else
			echo json_encode(array('error' => 'Not authorized.', JSON_PRETTY_PRINT));
	}

	private function handleAsyncRequest($params) {

		$result = array('error' => 'Request not handled.');
		$request = 'clients_autocomplete';

		if(isset($params['request']) && $params['request'] != '')
			$request = $params['request'];

		switch($request) {
			case 'clients_autocomplete':
				$result = $this->getResults($params['query']);
				break;

			case 'validate_interval':
				$result = $this->validateAppInterval($params['start'], $params['end'], $params['date'], $params['user_id']);
				break;

			case 'list_users':
				$result = $this->getUsers();
				break;
		}

		echo json_encode($result, JSON_PRETTY_PRINT);
	}

	private function getResults($query) {

		if(!isset($query) || $query == '')
			return;

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		return $proxy->getAutocompleteResults($query);
	}

	private function validateAppInterval($start, $end, $date, $userId) {
		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$apps = $proxy->getAppointmentsForDateByUser($date, $userId);

		foreach($apps as $app)
			if($start <= $app['start_time'] && $end >= $app['end_time'])
				return array('error' => 'overlapping 1', 'app' => $app);

			else if($start >= $app['start_time'] && $start < $app['end_time'])
				return array('error' => 'overlapping 2', 'app' => $app);

			else if($end > $app['start_time'] && $end < $app['end_time'])
				return array('error' => 'overlapping 3', 'app' => $app);

		return array('result' => 'valid');
	}

	private function getUsers() {
		$proxy = new UsersProxy(DBWrapper::cloneInstance());

		return $proxy->getAllUsers();
	}
}