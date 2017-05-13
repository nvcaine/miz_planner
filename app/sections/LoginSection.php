<?php
class LoginSection extends AbstractAuthSection {

	public function runGetMethod($params) {

		session_start();

		if($this->userIsLoggedIn()) {
			header('Location:' . $this->appFacade->getAppURL());
		} else {
			$this->view->display('login');
		}

	}

	public function runPostMethod($params) {

		session_start();

		$this->authenticate($params);
	}

	private function authenticate($params) {
		if(isset($params['username']) && isset($params['password']) &&
			$params['username'] == 'lisa' && $params['password'] == 'admin') {

			$_SESSION[Consts::USERNAME_INDEX] = 'lisa';
			$_SESSION[Consts::LOGGED_IN_INDEX] = true;

			header('Location:' . $this->appFacade->getAppURL());
		} else {
			$this->view->assign('login_failed', true);
			$this->view->display('login');
		}
	}
}