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

	public function getAllUsers() {

		$query = 'SELECT user_id,name,email,type FROM ' . self::TABLE;

		return $this->db->query($query);
	}

	public function addUser($name, $email, $passwordHash) {

		$values = array(
			'name' => $name,
			'email' => $email,
			'password' => $passwordHash
		);

		$fields = array('name','email','password');
		$tokens = array(':name',':email',':password');

		$query = 'INSERT INTO ' . self::TABLE . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $tokens) . ')';
		$this->db->query($query, $values, null, false);
	}

	public function updateUser($user_id, $name, $email, $passwordHash = '') {
		$values = array(
			'name' => $name,
			'email' => $email
		);
		$fields = array('name', 'email');

		if($passwordHash != '') {
			$values['password'] = $passwordHash;
			$fields[] = 'password';
		}

		$pairs = array();
		foreach($fields as $field)
			$pairs[] = $field . '=:' . $field;

		$query = 'UPDATE ' . self::TABLE . ' SET ' . implode(',', $pairs) . ' WHERE user_id=' . $user_id;
		$this->db->query($query, $values, null, false);
	}

	public function deleteUser($user_id) {
		$query = 'DELETE FROM ' . self::TABLE . ' WHERE user_id = :user_id';
		$this->db->query($query, array('user_id' => $user_id), null, false);
	}
}