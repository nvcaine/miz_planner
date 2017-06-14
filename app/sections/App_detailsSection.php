<?php
class App_detailsSection extends AbstractSection {

	public function runGetMethod($params) {

		$proxy = new AppsProxy(DBWrapper::cloneInstance());
		$app = $proxy->getAppointmentById($params['app_id']);

		$this->view->assign('app', $app);
		$this->view->assign('week', $params['week']);
		$this->view->display('app_details');
	}
}