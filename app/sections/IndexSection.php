<?php
class IndexSection extends AbstractMenuSection {
	
	public function runGetMethod($params) {

		session_start();

		$this->init();
		$this->view->display('index');
	}
}