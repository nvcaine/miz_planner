<?php
class UsersSection extends AbstractMenuSection {

	public function runGetMethod($params) {

		session_start();

		if(!$this->userIsLoggedIn()) {
			$peristent = $this->checkPersistentLogin();
	
			if(!$peristent)
				header('Location: ' . $this->appFacade->getAppURL());
		}

		$this->showView();
	}

	public function runPostMethod($params) {

		session_start();

		if(!$this->userIsLoggedIn()) {

			header('Location: ' . $this->appFacade->getAppURL());

		} else {

			if(isset($params['new-user-add-action']))
				$this->addUser($params);
		}

		$this->showView();
	}

	private function showView() {

		$this->init();

		if($this->userIsAdmin()) {
			$usersProxy = new UsersProxy(DBWrapper::cloneInstance());
			$this->view->assign('users', $usersProxy->getAllUsers());
		}

		$this->view->display('users');
	}

	private function addUser($params) {

		$usersProxy = new UsersProxy(DBWrapper::cloneInstance());
		$usersProxy->addUser(
			$params['new-user-name'],
			$params['new-user-email'],
			hash('sha256', $params['new-user-password'])
		);
	}
}