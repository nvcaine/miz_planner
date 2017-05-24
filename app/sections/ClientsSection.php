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
		$this->loadClients();
		$this->view->display('clients');
	}

	private function handlePostRequest($params) {

		if(isset($params['new-client-add-action']))
			$this->addNewClient($params);
	}

	private function addNewClient($params) {

		$clients = json_decode(file_get_contents('json/clients.json'));
		$newClient = array(
			'id' => time(),
			'first_name' => $params['new-client-first-name'],
			'last_name' => $params['new-client-last-name'],
			'date_added' => date('m/d/Y')
		);

		if(isset($params['new-client-birthdate']) && $params['new-client-birthdate'] != '')
			$newClient['birth_date'] = $params['new-client-birthdate'];

		if(isset($params['new-client-phone']) && $params['new-client-phone'] != '')
			$newClient['phone'] = $params['new-client-phone'];

		if(isset($params['new-client-mail']) && $params['new-client-phone'] != '')
			$newClient['mail'] = $params['new-client-mail'];

		$clients[] = $newClient;

		file_put_contents('json/clients.json', json_encode($clients, JSON_PRETTY_PRINT));
	}

	private function loadClients() {

		$clients = json_decode(file_get_contents('json/clients.json'));
		$this->view->assign('clients', $clients);
	}
}