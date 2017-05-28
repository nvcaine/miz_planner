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

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		$proxy->addClient($params);
	}

	private function loadClients() {

		//$clients = json_decode(file_get_contents('json/clients.json'));
		$db = DBWrapper::cloneInstance();
		$clients = $db->query('SELECT * FROM clients ORDER BY last_name');
		$this->view->assign('clients', $clients);
	}
}