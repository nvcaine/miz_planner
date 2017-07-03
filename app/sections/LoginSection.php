<?php
class LoginSection extends AbstractAuthSection {

	public function runGetMethod($params) {

		session_start();

		if($this->userIsLoggedIn())
			header('Location:' . $this->appFacade->getAppURL());

		$this->view->display('login');
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

		$this->saveUserSessionData($user);
	}

	private function persistLogin($user_id) {

		$selector = $this->getRandomToken(12);
		$validator = $this->getRandomToken(40);

		$loginsProxy = new LoginsProxy(DBWrapper::cloneInstance());
		$loginsProxy->addLogin($selector, hash('sha256', $validator), $user_id);

		setcookie(Consts::LOGIN_TOKEN, $selector . ':' . $validator, time() + (3600 * Consts::COOKIE_HOUR_INTERVAL), '/');
	}
}