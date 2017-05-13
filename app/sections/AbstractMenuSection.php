<?php
abstract class AbstractMenuSection extends AbstractSection {

	const LOGIN_SECTION = 'login';
	const LOGOUT_SECTION = 'logout';

	protected function init($userIsLoggedIn = false) {
		$this->initMenu($this->appFacade->getSections(), $userIsLoggedIn);
	}

	private function initMenu($sections, $userIsLoggedIn) {
		$this->view->assign('menuItems', $this->parseMenuItems($sections, $userIsLoggedIn));
	}

	private function parseMenuItems($menuItems, $loggedIn) {

		foreach($menuItems as $index => $item)
			if(($loggedIn && $item->name == self::LOGIN_SECTION) || (!$loggedIn && $item->name == self::LOGOUT_SECTION))
				unset($menuItems[$index]);

		return $menuItems;
	}
}