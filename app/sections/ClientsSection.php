<?php
class ClientsSection extends AbstractMenuSection {
	
	public function runGetMethod($params) {

		$this->checkIfUserLoggedIn();
		$this->showView($params);
	}

	public function runPostMethod($params) {

		$this->checkIfUserLoggedIn();
		$this->handlePostRequest($params);
		$this->showView($params);
	}

	private function checkIfUserLoggedIn() {

		session_start();

		if(!$this->userIsLoggedIn())
			header('Location: ' . $this->appFacade->getAppURL());
	}

	private function showView($params) {

		$this->init();
		$this->view->display('clients');
	}

	private function handlePostRequest($params) {

		if(isset($params['new-client-add-action']))
			$this->addNewClient($params);
	}

	private function addNewClient($params) {

		$clients = json_decode(file_get_contents('json/clients.json'));
		$newClient = array(
			'first_name' => $params['new-client-first-name'],
			'last_name' => $params['new-client-last-name'],
			'birth_date' => $params['new-client-birthdate'],
			'date_added' => date('m/d/Y')
		);

		if(isset($params['new-client-phone']))
			$newClient['phone'] = $params['new-client-phone'];

		$clients[] = $newClient;

		file_put_contents('json/clients.json', json_encode($clients, JSON_PRETTY_PRINT));
	}
}