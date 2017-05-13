<?php
class IndexSection extends AbstractSection {
	
	public function runGetMethod($params) {

		$this->view->display('index');
	}
}