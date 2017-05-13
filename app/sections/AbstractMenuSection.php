<?php
abstract class AbstractMenuSection extends AbstractAuthSection {

	const LOGIN_SECTION = 'login';

	private $requiresLogin = array('apps', 'clients', 'logout');

	protected function init() {
		$this->initMenu($this->appFacade->getSections());
	}

	private function initMenu($sections) {
		$this->view->assign('menuItems', $this->parseMenuItems($sections));
	}

	private function parseMenuItems($menuItems) {

		$loggedIn = $this->userIsLoggedIn();

		foreach($menuItems as $index => $item)
			if(
				($loggedIn && $item->name == self::LOGIN_SECTION) ||
				(!$loggedIn && array_search($item->name, $this->requiresLogin) !== false)
				)
				
				unset($menuItems[$index]);

		return $menuItems;
	}
}