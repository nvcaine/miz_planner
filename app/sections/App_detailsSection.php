<?php
class App_detailsSection extends AbstractSection {

	public function runGetMethod($params) {

		session_start();

		if(isset($_SESSION[Consts::LOGGED_IN_INDEX]) && ($_SESSION[Consts::LOGGED_IN_INDEX] === true)) {

			$proxy = new AppsProxy(DBWrapper::cloneInstance());
			$app = $proxy->getAppointmentById($params['app_id']);
			$this->view->assign('app', $app);
			$this->view->assign('week', $params['week']);
			$this->view->display('app_details');
		} else {
			echo 'Not authorized.';
		}
	}
}