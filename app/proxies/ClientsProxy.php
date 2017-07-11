<?php
class ClientsProxy extends AbstractProxy {

	const TABLE = 'miz_clients';

	public function getClients() {
		return $this->db->query('SELECT * FROM ' . self::TABLE . ' ORDER BY last_name');
	}

	public function getAutocompleteResults($query) {
		$sqlQuery = "SELECT * FROM " . self::TABLE . " WHERE last_name LIKE '$query%' OR first_name LIKE '$query%' OR CONCAT(first_name, ' ', last_name) LIKE '$query%' ORDER BY last_name";
		return $this->db->query($sqlQuery);
	}

	public function addClient($params) {

		$values = array(
			'last_name' => $params['new-client-last-name'],
			'added' => date('Y-m-d')
		);

		$fields = array('last_name', 'added');
		$tokens = array(':last_name', ':added');

		if(isset($params['new-client-first-name']) && $params['new-client-first-name'] != '') {
			$values['first_name'] = $params['new-client-first-name'];
			$fields[] = 'first_name';
			$tokens[] = ':first_name';
		}

		if(isset($params['new-client-birthday']) && $params['new-client-birthday'] != '') {
			$values['birthday'] = $params['new-client-birthday'];
			$fields[] = 'birthday';
			$tokens[] = ':birthday';
		}

		if(isset($params['new-client-phone']) && $params['new-client-phone'] != '') {
			$values['phone'] = $params['new-client-phone'];
			$fields[] = 'phone';
			$tokens[] = ':phone';
		}

		if(isset($params['new-client-email']) && $params['new-client-email'] != '') {
			$values['email'] = $params['new-client-email'];
			$fields[] = 'email';
			$tokens[] = ':email';
		}

		if(isset($params['new-client-address']) && $params['new-client-address'] != '') {
			$values['address'] = $params['new-client-address'];
			$fields[] = 'address';
			$tokens[] = ':address';
		}

		$query = 'INSERT INTO ' . self::TABLE . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $tokens) . ')';
		$this->db->query($query, $values, null, false);
	}

	public function updateClient($params) {
		$values = array(
			':last_name' => $params['edit-client-last-name'],
			':birthday' => $params['edit-client-birthday'],
			':phone' => $params['edit-client-phone'],
			':email' => $params['edit-client-email'],
			':address' => $params['edit-client-address']
		);

		$fields = array('last_name', 'birthday', 'phone', 'email', 'address');

		if(isset($params['edit-client-first-name']) && $params['edit-client-first-name'] != '') {
			$values[':first_name'] = $params['edit-client-first-name'];
			$fields[] = 'first_name';
		}

		$pairs = array();
		foreach($fields as $field)
			$pairs[] = $field . '=:' . $field;

		$query = 'UPDATE ' . self::TABLE . ' SET ' . implode(',', $pairs) . ' WHERE client_id=' . $params['edit-client-id'];
		$this->db->query($query, $values, null, false);
	}

	public function deleteClient($params) {
		$query = 'DELETE FROM ' . self::TABLE . ' WHERE client_id = :client_id';
		$this->db->query($query, array('client_id' => $params['edit-client-id']), null, false);
	}

	public function getUpcomingBirthdays() {
		$monday = date('Y-m-d', strtotime('monday this week'));
		$date = 'DATE_ADD(birthday, INTERVAL YEAR(\''.$monday.'\') - YEAR(birthday) + IF(DAYOFYEAR(\''.$monday.'\') > DAYOFYEAR(birthday),1,0) YEAR)';

		$query = 'SELECT *, ' . $date . ' AS cdate FROM ' . self::TABLE . ' WHERE ' . $date . ' BETWEEN \'' . $monday . '\' AND DATE_ADD(\'' . $monday . '\', INTERVAL 6 DAY) ORDER BY cdate';
		$results = $this->db->query($query);

		foreach($results as $key => $result) {
			$date = date('Y') . '-' . date('m-d', strtotime($result['birthday']));
			$results[$key]['week_birthday'] = date('l M d', strtotime($date));
			$results[$key]['birthyear'] = date('Y', strtotime($result['birthday']));
			$results[$key]['age'] = date('Y') - $results[$key]['birthyear'];
		}

		return $results;
	}
}