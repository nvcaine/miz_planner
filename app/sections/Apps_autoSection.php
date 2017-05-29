<?php
class Apps_autoSection extends AbstractSection {

	public function runGetMethod($params) {

		header("Content-type: application/json");
		echo json_encode($this->getResults($params['query']), JSON_PRETTY_PRINT);
	}

	private function getResults($query) {

		if(!isset($query) || $query == '')
			return;

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		return $proxy->getAutocompleteResults($query);
	}
}