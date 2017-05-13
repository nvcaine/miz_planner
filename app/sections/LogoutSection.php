<?php
class LogoutSection extends AbstractAuthSection {

	public function runGetMethod($params) {

		session_start();

		if($this->userIsLoggedIn()) {
			unset($_SESSION[Consts::LOGGED_IN_INDEX]);
			unset($_SESSION[Consts::USERNAME_INDEX]);
		}

		header('Location: ' . $this->appFacade->getAppURL());
	}
}