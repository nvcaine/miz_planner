<?php
class AbstractAuthSection extends AbstractSection {

	protected function userIsLoggedIn() {

		return isset($_SESSION[Consts::LOGGED_IN_INDEX]) && ($_SESSION[Consts::LOGGED_IN_INDEX] === true);
	}

	protected function checkPersistentLogin() {

		if(isset($_COOKIE[Consts::LOGIN_TOKEN]))
			return $this->checkLoginToken($_COOKIE[Consts::LOGIN_TOKEN]);

		return false;
	}

	protected function getRandomToken($length = 20) {

		return bin2hex(openssl_random_pseudo_bytes($length / 2));
	}

	private function checkLoginToken($token) {

		$split = explode(':', $token);
		$selector = $split[0];
		$validator = $split[1];

		$loginsProxy = new LoginsProxy(DBWrapper::cloneInstance());
		$login = $loginsProxy->getLoginBySelector($selector);

		if($login != null && $this->validateToken($validator, $login, Consts::COOKIE_HOUR_INTERVAL))
			return $this->reauthenticate($login);

		return false;
	}

	private function validateToken($validator, $login, $expireIntervalHours = 12) {

		$isTokenValid = $this->validateHash(hash('sha256', $validator), $login['hash']);
		$isLoginExpired = round((time() - strtotime($login['logged_in'])) / 3600) > $expireIntervalHours;

		return ($isTokenValid && !$isLoginExpired);
	}

	private function reauthenticate($login) {

		$usersProxy = new UsersProxy(DBWrapper::cloneInstance());
		$user = $usersProxy->getUserById($login['user_id']);

		if($user != null) {		

			$_SESSION[Consts::USERNAME_INDEX] = $user['name'];
			$_SESSION[Consts::USERTYPE_INDEX] = $user['type'];
			$_SESSION[Consts::LOGGED_IN_INDEX] = true;

			$this->updatePersistentLogin($login['login_id']);
			//header('Location: ' . $this->appFacade->getAppURL() . 'apps/');
			header('Refresh:0');

			return true;
		}

		return false;
	}

	private function updatePersistentLogin($login_id) {

		$selector = $this->getRandomToken(12);
		$validator = $this->getRandomToken(40);

		$loginsProxy = new LoginsProxy(DBWrapper::cloneInstance());
		$loginsProxy->updateLogin($login_id, $selector, hash('sha256', $validator));

		setcookie(Consts::LOGIN_TOKEN, $selector . ':' . $validator, time() + (3600 * Consts::COOKIE_HOUR_INTERVAL), '/');
	}

	  function validateHash($hash, $agains) {

		if(strlen($hash) != strlen($agains))
			return false;

		$res = $hash ^ $agains;
		$ret = 0;
		for($i = strlen($res) - 1; $i >= 0; $i--)
			$ret |= ord($res[$i]);

		return !$ret;
	}
}