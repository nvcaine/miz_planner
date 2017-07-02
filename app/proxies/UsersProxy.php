<?php
class UsersProxy extends AbstractProxy {

	const TABLE = 'miz_users';

	public function getUserByCredentials($username, $passwordHash) {

		$query = 'SELECT * FROM ' . self::TABLE. ' WHERE email = :email AND password = :password';
		$fields = array('email' => $username, 'password' => $passwordHash);
		$result = $this->db->query($query, $fields);

		if($this->db->affectedRowsCount() < 1)
			return null;

		return $result;
	}

	public function getUserById($user_id) {

		$query = 'SELECT * FROM ' . self::TABLE. ' WHERE user_id = :user_id';
		$result = $this->db->query($query, array('user_id' => $user_id));

		if($this->db->affectedRowsCount() < 1)
			return null;

		return $result[0];
	}
}