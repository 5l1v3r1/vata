<?php
class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
	private $_acl = null;
	private $_auth = null;

	const ACCESS_DENIED = 401;

	/*
	 *
	 */
	public function __construct()
	{
		$this->_acl = $this->getRole();
		$this->_auth = Zend_Auth::getInstance();
	}

	protected function getRole()
	{
		$acl = new Zend_Acl();

		$acl->addResource('index');
		$acl->addResource('error');

		$acl->addResource('ajax');
		$acl->addResource('admin');
		$acl->addResource('search');
		$acl->addResource('album');
		$acl->addResource('user');
		$acl->addResource('cms');
		$acl->addResource('cronjob');

		$acl->addRole('guest');
		$acl->addRole('user', 'guest');
		$acl->addRole('editor', 'user');
		$acl->addRole('admin', 'editor');

		#admin premissions

		$acl->allow('admin', 'admin', array('cache', 'users'));
		$acl->allow('admin', 'error', array('error'));
		$acl->allow('editor', 'cms', array('list', 'create', 'edit','preview'));
		$acl->allow('editor', 'admin', array('index'));
		$acl->allow('editor', 'album', array('edit'));

		#user permissions
		$acl->allow('user', 'album', array('create', 'propose'));

		#guest permissions
		$acl->allow('guest', 'index', array('index'));
		$acl->allow('guest', 'cms', array('support', 'view', 'index'));
		$acl->allow('guest', 'search', array('index','reindex'));
		$acl->allow('guest', 'ajax', array('index', 'user', 'album'));
		$acl->allow('guest', 'user', array('login', 'logout', 'google', 'facebook', 'vkontakte', 'twitter'));
		$acl->allow('guest', 'album', array('index','view'));
		$acl->allow('guest', 'cronjob', array('index','twitter', 'facebook', 'vk', 'sitemap', 'subscribe'));
		$acl->allow('guest', 'error', array ('page404'));

		Zend_Registry::set('Zend_Acl', $acl);

		$identity = Zend_Auth::getInstance()->getStorage()->read();

		$role = !empty($identity->role) ? $identity->role : 'guest';
		Zend_Registry::set('currentRole', $role);

		return $acl;

	}

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{

		// get current controller
		$resource = $request->getControllerName();

		// get current action
		$action = $request->getActionName();

		// get role
		$identity = $this->_auth->getStorage()->read();

		$role = !empty($identity->role) ? $identity->role : 'guest';

		Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);

		if (!$this->_acl->isAllowed($role, $resource, $action)) {

			if ($resource != 'error') $request->setControllerName('error')->setActionName('page404');
			#throw new Zend_Acl_Exception("This page is not accessible.", Application_Plugin_AccessCheck::ACCESS_DENIED);
		}
	}
}