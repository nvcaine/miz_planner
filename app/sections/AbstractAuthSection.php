<?php
class AbstractAuthSection extends AbstractSection {
	
	protected function userIsLoggedIn() {
		return isset($_SESSION[Consts::LOGGED_IN_INDEX]) && ($_SESSION[Consts::LOGGED_IN_INDEX] === true);
	}

	protected function checkPersistentLogin() {}
}