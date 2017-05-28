<?php
class AppsProxy extends AbstractProxy {

	public function addApp($clientId, $day, $hour) {

		$query = 'INSERT INTO apps (client_id, date) VALUES (:client_id, :date)';
		$values = array(
			'client_id' => $clientId,
			'date' => date('Y-m-d H:i:s', strtotime($day . ' ' . $hour))
		);

		$this->db->query($query, $values, null, false);
	}

	public function deleteApp($app_id) {
		$query = 'DELETE FROM apps WHERE app_id = :app_id';
		$this->db->query($query, array('app_id' => $app_id), null, false);
	}

	public function updateApp($app_id, $status) {
		$query = "UPDATE apps SET status='$status' WHERE app_id = $app_id";
		$values = array(
			'status' => $status,
			'app_id' => $app_id
		);

		$this->db->query($query, null, null, false);
	}

	public function getAppointmentsForWeek($week) {

		$start = $this->getDateFromWeekday($week, 'monday');
		$end = $this->getDateFromWeekday($week, 'sunday');
		$query = 'SELECT * FROM apps RIGHT JOIN clients ON apps.client_id = clients.client_id';
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