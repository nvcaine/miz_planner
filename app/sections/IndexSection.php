<?php
class IndexSection extends AbstractMenuSection {
	
	public function runGetMethod($params) {

		$this->init();
		$this->view->display('index');
	}
}