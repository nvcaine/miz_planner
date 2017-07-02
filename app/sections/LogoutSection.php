<?php
class LogoutSection extends AbstractAuthSection {

	public function runGetMethod($params) {

		session_start();

		if($this->userIsLoggedIn()) {
			unset($_SESSION[Consts::LOGGED_IN_INDEX]);
			unset($_SESSION[Consts::USERNAME_INDEX]);
			setcookie(Consts::LOGIN_TOKEN, null, -1, '/');
		}

		header('Location: ' . $this->appFacade->getAppURL());
	}
}