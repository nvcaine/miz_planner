<?php
class IndexSection extends AbstractMenuSection {
	
	public function runGetMethod($params) {

		session_start();

		if(!$this->userIsLoggedIn()) {
			$peristent = $this->checkPersistentLogin();
	
			if(!$peristent)
				header('Location: ' . $this->appFacade->getAppURL());
		}

		$this->init();
		$this->view->display('index');
	}
}