<?php
class UserappsProxy extends AbstractProxy {

	const TABLE = 'miz_userapps';

	public function addUserApp($app_id, $user_id, $added_by) {

		$values = array(
			'app_id' => $app_id,
			'user_id' => $user_id,
			'added_by' => $added_by
		);

		$tokens = array(':app_id, :user_id, :added_by');
		$query = 'INSERT INTO ' . self::TABLE . '(' . implode(',', array_keys($values)) . ') VALUES (' . implode(',', $tokens) . ')';

		$this->db->query($query, $values, null, false);
	}
}