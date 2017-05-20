<?php
class ClientsSection extends AbstractMenuSection {
	
	public function runGetMethod($params) {
		session_start();

		if(!$this->userIsLoggedIn()) {
			header('Location: ' . $this->appFacade->getAppURL());
		} else {
			$this->showView($params);
		}
	}

	private function showView($params) {

		$this->init();
		$this->view->display('clients');
	}
}