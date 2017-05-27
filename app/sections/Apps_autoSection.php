<?php
class Apps_autoSection extends AbstractSection {

	public function runGetMethod($params) {

		header("Content-type: application/json");
		echo json_encode($this->getResults($params['query']), JSON_PRETTY_PRINT);
	}

	private function getResults($query) {

		$db = DBWrapper::cloneInstance();
		$query = "SELECT * FROM clients WHERE last_name LIKE '$query%' OR first_name LIKE '$query%' ORDER BY last_name";
		return $db->query($query);
	}
}