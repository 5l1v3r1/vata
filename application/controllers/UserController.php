<?php

class UserController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
	}

	public function loginAction()
	{


	}

	public function logoutAction()
	{

		Zend_Auth::getInstance()->clearIdentity();
		$this->redirect(My_View_Helper_Url::url(1));

	}

	public function googleAction()
	{
		// action body
	}

	public function facebookAction()
	{

		$config = Zend_Registry::get('config');
		$model = new Application_Model_Facebook();
		$url = new My_View_Helper_Url();
		$users = new Application_Model_User();

		$facebook = new Facebook_Facebook(array(
			'appId' => $config->facebook->appId,
			'secret' => $config->facebook->token,
		));

		$array = array();

		if ($facebook->getUser()) {


			$model->auth($facebook->api('/me', 'GET'));
			$identity = Zend_Auth::getInstance()->getStorage()->read();
		}

		$redirect = (preg_match("#login#", $_SESSION["urlsaver"])) ? $url->url(1) : $_SESSION["urlsaver"];
		header("location:{$redirect}/");

	}

	public function vkontakteAction()
	{
		$vkModel = new Application_Model_Vkontake();
		$url = new My_View_Helper_Url();
		$vkModel->vkLogin($_GET['code']);

		header("location:{$url->url(1)}/");
	}

	public function twitterAction()
	{


		#$twitterModel = new Application_Model_Twitter();

		if ($this->getRequest()->getParam('oauth_verifier')) {

			#$twitterModel->twSign($this->getRequest()->getParam('oauth_verifier'));

		} else {

			#$twitterModel->twSign();

		}

	}


}













