<?php
class LoginsProxy extends AbstractProxy {

	const TABLE = 'miz_logins';
	
	public function addLogin($selector, $hash, $user_id) {

		$values = array(
			'selector' => $selector,
			'hash' => $hash,
			'user_id' => $user_id,
		);

		$query = 'INSERT INTO ' . self::TABLE . ' (selector, hash, user_id) VALUES (:selector, :hash, :user_id)';
		$this->db->query($query, $values, null, false);
	}

	public function getLoginBySelector($selector) {

		$query = 'SELECT * FROM ' . self::TABLE . ' WHERE selector = :selector';

		$result = $this->db->query($query, array('selector' => $selector));

		if($this->db->affectedRowsCount() < 1)
			return null;

		return $result[0];
	}

	public function updateLogin($login_id, $selector, $hash) {

		$values = array(
			'selector' => $selector,
			'hash' => $hash,
			'logged_in' => date('Y-m-d H:i:s')
		);

		$fields = array('selector', 'hash', 'logged_in');

		$pairs = array();
		foreach($fields as $field)
			$pairs[] = $field . '=:' . $field;

		$query = 'UPDATE ' . self::TABLE . ' SET ' . implode(',', $pairs) . ' WHERE login_id=' . $login_id;

		$this->db->query($query, $values, null, false);
	}

	public function clearUserLogins($user_id) {
		$query = 'DELETE FROM ' . self::TABLE . ' WHERE user_id = :user_id';
		$this->db->query($query, array('user_id' => $user_id), null, false);
	}
}