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
		/*$clients = json_decode(file_get_contents('json/clients.json'));
		$result = array();

		foreach($clients as $client)
			if(
				strpos(strtolower($client->first_name), strtolower($query)) !== false ||
				strpos(strtolower($client->last_name), strtolower($query)) !== false ||
				strpos(strtolower($client->first_name . ' ' . $client->last_name), strtolower($query)) !== false
				)
				$result[] = $client;

		usort($result, array($this, "clientCompare"));
		return $result;*/
	}

	private function clientCompare($c1, $c2) {
		return strcmp($c1->last_name, $c2->last_name);
	}
}