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

		$user = $this->getUserByCredentials($params['username'], $params['password']);

		if($user != null) {
			$this->logUserIn($user[0], isset($params['remember_me']));
			header('Location:' . $this->appFacade->getAppURL() . 'apps/');
		}

		$this->view->assign('login_failed', true);
		$this->view->display('login');
	}

	private function getUserByCredentials($username, $password) {

		$userProxy = new UsersProxy(DBWrapper::cloneInstance());

		return $userProxy->getUserByCredentials($username, hash('sha256', $password));
	}

	private function logUserIn($user, $remember = false) {

		if($remember)
			$this->persistLogin($user['user_id']);

		$_SESSION[Consts::USERNAME_INDEX] = $user['name'];
		$_SESSION[Consts::LOGGED_IN_INDEX] = true;
	}

	private function persistLogin($user_id) {
		$selector = $this->getLoginToken(12);
		$validator = $this->getLoginToken(40);

		$loginsProxy = new LoginsProxy(DBWrapper::cloneInstance());
		$loginsProxy->addLogin($selector, hash('sha256', $validator), $user_id);

		setcookie(Consts::LOGIN_TOKEN, $selector . ':' . $validator);
	}

	private function getLoginToken($length = 20) {

		return bin2hex(openssl_random_pseudo_bytes($length / 2));
	}
}