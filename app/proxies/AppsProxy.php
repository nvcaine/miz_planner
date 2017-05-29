<?php
class AppsProxy extends AbstractProxy {

	const TABLE = 'miz_apps';

	public function addApp($clientId, $day, $hour) {

		$query = 'INSERT INTO ' . self::TABLE . ' (client_id, date) VALUES (:client_id, :date)';
		$values = array(
			'client_id' => $clientId,
			'date' => date('Y-m-d H:i:s', strtotime($day . ' ' . $hour))
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

	private function getDateFromWeekday($week, $weekday) {
		return date('Y-m-d H:i:s', strtotime($weekday, strtotime('2017W' . $week)));
	}

	private function parseApps($apps) {

		$result = array();

		foreach($apps as $app) {
			$app['day'] = date('D M d', strtotime($app['date']));
			$app['hour'] = date('H:i', strtotime($app['date']));
			$result[] = $app;
		}

		return $result;
	}
}