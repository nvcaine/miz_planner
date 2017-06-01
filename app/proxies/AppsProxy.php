<?php
class AppsProxy extends AbstractProxy {

	const TABLE = 'miz_apps';

	public function addApp($clientId, $day, $startTime, $endTime, $type, $notes) {

		$query = 'INSERT INTO ' . self::TABLE .
			' (client_id, date, start_time, end_time, type, notes) VALUES (:client_id, :date, :start_time, :end_time, :type, :notes)';
	
		$values = array(
			'client_id' => $clientId,
			'date' => $day,
			'start_time' => $startTime,
			'end_time' => $endTime,
			'type' => $type,
			'notes' => $notes
		);

		$this->db->query($query, $values, null, false);
	}

	public function deleteApp($app_id) {
		$query = 'DELETE FROM ' . self::TABLE . ' WHERE app_id = :app_id';
		$this->db->query($query, array('app_id' => $app_id), null, false);
	}

	public function updateApp($app_id, $status) {
		$query = "UPDATE " . self::TABLE . " SET status='$status' WHERE app_id = $app_id";
		$values = array(
			'status' => $status,
			'app_id' => $app_id
		);

		$this->db->query($query, null, null, false);
	}

	public function getAppointmentsForWeek($week) {

		$start = $this->getDateFromWeekday($week, 'monday');
		$end = $this->getDateFromWeekday($week, 'sunday');
		$query = 'SELECT * FROM ' . self::TABLE . ' RIGHT JOIN miz_clients ON miz_apps.client_id = miz_clients.client_id';
		$where = 'WHERE (date BETWEEN \'' . $start . '\' AND \'' . $end . '\')';
		$apps = $this->db->query($query . ' ' . $where);

		return $this->parseApps($apps);
	}

	public function getAppointmentById($app_id) {

		$query = 'SELECT * FROM ' . self::TABLE . ' RIGHT JOIN miz_clients ON miz_apps.client_id = miz_clients.client_id';
		$where = 'WHERE app_id = :app_id';
		$apps = $this->db->query($query . ' ' . $where, array('app_id' => $app_id));

		return $this->parseApps($apps)[0];
	}

	private function getDateFromWeekday($week, $weekday) {
		return date('Y-m-d', strtotime($weekday, strtotime('2017W' . $week)));
	}

	private function parseApps($apps) {

		$result = array();

		foreach($apps as $app) {
			$app['day'] = date('D M d', strtotime($app['date']));
			$app['start_time'] = date('H:i', strtotime($app['start_time']));
			$app['end_time'] = date('H:i', strtotime($app['end_time']));
			$app['client_age'] = $this->getAgeFromDate($app['birthday']);
			$result[] = $app;
		}

		return $result;
	}

	private function getAgeFromDate($date) {

		$birthDate = explode("-", $date);
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
			? ((date("Y") - $birthDate[0]) - 1)
			: (date("Y") - $birthDate[0]));

		return $age;
	}
}