<?php
class UsersSection extends AbstractMenuSection {

	public function runGetMethod($params) {

		session_start();

		if(!$this->userIsLoggedIn()) {
			$peristent = $this->checkPersistentLogin();
	
			if(!$peristent)
				header('Location: ' . $this->appFacade->getAppURL());
		}

		$this->init();

		if(isset($_SESSION[Consts::USERTYPE_INDEX]) && $_SESSION[Consts::USERTYPE_INDEX] == 'admin') {
			$usersProxy = new UsersProxy(DBWrapper::cloneInstance());
			$this->view->assign('users', $usersProxy->getAllUsers());
		}

		$this->view->display('users');
	}
}