<?php

class AdminController extends Zend_Controller_Action{

	public function init(){

	}

	public function indexAction(){

		$terroristsDb = new Application_Model_DbTable_Terrorist();
		$identity       = Zend_Auth::getInstance()->getStorage()->read();

		$view["terroristsPending"] = $terroristsDb->getTerrorists(0, 0 , 10, 0);
		$view["terroristsActive"] = $terroristsDb->getTerrorists(1, 0 , 1000, 0);
		$view["indentityRole"] = $identity->role;

		$this->view->params = $view;

	}

	public function cacheAction(){

		$cahce = new Application_Model_Cache();

		if($this->getRequest()->getParam("keys")){
			$cahce->getKeys();
		}
		if($this->getRequest()->getParam("drop")){
			$cahce->clearCache();
		}

	}

	public function usersAction(){

		$usersDb = new Application_Model_DbTable_Users();

		$view["users"] = $usersDb->getUsersByStatus();
		$view["banned"] = $usersDb->getUsersByStatus(1);

		$this->view->params = $view;

	}

}