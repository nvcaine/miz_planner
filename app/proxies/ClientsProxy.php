<?php
class ClientsProxy extends AbstractProxy {

	public function addClient($params) {

		$values = array(
			'first_name' => $params['new-client-first-name'],
			'last_name' => $params['new-client-last-name'],
			'added' => date('Y-m-d')
		);

		$fields = array('first_name', 'last_name', 'added');
		$tokens = array(':first_name', ':last_name', ':added');

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

		$query = 'INSERT INTO clients (' . implode(',', $fields) . ') VALUES (' . implode(',', $tokens) . ')';
		$this->db->query($query, $values, null, false);
	}
}