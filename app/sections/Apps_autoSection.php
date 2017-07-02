<?php
class Apps_autoSection extends AbstractSection {

	public function runGetMethod($params) {

		header("Content-type: application/json");

		session_start();

		if(isset($_SESSION[Consts::LOGGED_IN_INDEX]) && ($_SESSION[Consts::LOGGED_IN_INDEX] === true))
			echo json_encode($this->getResults($params['query']), JSON_PRETTY_PRINT);
		else
			echo json_encode(array('error' => 'Not authorized.', JSON_PRETTY_PRINT);
	}

	private function getResults($query) {

		if(!isset($query) || $query == '')
			return;

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		return $proxy->getAutocompleteResults($query);
	}
}