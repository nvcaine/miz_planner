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
}