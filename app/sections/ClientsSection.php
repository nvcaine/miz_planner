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

		if(!$this->userIsLoggedIn()) {
			$peristent = $this->checkPersistentLogin();
	
			if(!$peristent)
				header('Location: ' . $this->appFacade->getAppURL());
		}
	}

	private function showView($params) {

		$this->init();
		$this->loadClients();
		$this->getUpcomingBirthdays();
		$this->view->display('clients');
	}

	private function handlePostRequest($params) {

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());

		if(isset($params['new-client-add-action']))
			$proxy->addClient($params);

		if(isset($params['edit-client-action']))
			$proxy->updateClient($params);

		if(isset($params['delete-client-action']))
			$proxy->deleteClient($params);
	}

	private function loadClients() {

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		$this->view->assign('clients', $proxy->getClients());
	}

	private function getUpcomingBirthdays() {

		$proxy = new ClientsProxy(DBWrapper::cloneInstance());
		$this->view->assign('clients_birthdays', $proxy->getUpcomingBirthdays());
	}
}