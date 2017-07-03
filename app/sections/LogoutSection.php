<?php
class LogoutSection extends AbstractAuthSection {

	public function runGetMethod($params) {

		session_start();

		if($this->userIsLoggedIn()) {
			unset($_SESSION[Consts::LOGGED_IN_INDEX]);
			unset($_SESSION[Consts::USERNAME_INDEX]);
			unset($_SESSION[Consts::USERTYPE_INDEX]);
			unset($_SESSION[Consts::USERID_INDEX]);

			if(isset($_COOKIE[Consts::LOGIN_TOKEN]))
				$this->deletePersistentLogin();
		}

		header('Location: ' . $this->appFacade->getAppURL());
	}

	private function deletePersistentLogin() {
		$split = explode(':', $_COOKIE[Consts::LOGIN_TOKEN]);
		$selector = $split[0];

		$loginsProxy = new LoginsProxy(DBWrapper::cloneInstance());
		$login = $loginsProxy->getLoginBySelector($selector);

		if($login != null)
			$loginsProxy->clearUserLogins($login['user_id']);

		setcookie(Consts::LOGIN_TOKEN, null, -1, '/');
	}
}