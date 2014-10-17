<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initCache()
	{
		$options = $this->getOptions();

		if (isset($options['cache'])) {
			$cache = Zend_Cache::factory(
				$options['cache']['frontend']['type'],
				$options['cache']['backend']['type'],
				$options['cache']['frontend']['options'],
				$options['cache']['backend']['options']
			);

			Zend_Registry::set('cache', $cache);
			return $cache;
		}
	}

	protected function _initAcl()
	{

		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Application_Plugin_AccessCheck());

	}

	function _initViewRes()
	{

		$this->bootstrap('view');
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();

		$view->addHelperPath("My/View/Helper", "My_View_Helper");
		return $view;

	}

	protected  function _initRoutes(){

		#щоб не було проблем з укр і рус перекладами
		setlocale(LC_ALL, "ru_RU.utf-8");

		$this->bootstrap('FrontController');
		$front = $this->getResource('FrontController');

	}

	protected function _initAutoload()
	{

		$frontController = Zend_Controller_Front::getInstance();
		Zend_Session::start();

		// load configuration
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive ()
        );
		$frontController->setBaseUrl($config->baseurl);
		Zend_Registry::set('config', $config);

	}

	protected function _initTranslate()
	{
		
		#$bro = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		#$langs = array("ua","ru","en","lv","ge","it","pl", "lt");

		if (preg_match("/^\/([a-zA-Z]{2})($|\/)/", $_SERVER['REQUEST_URI'], $matches)) {
			$lang = $matches[1];
			$_COOKIE['language'] = $lang;
		}

		if(isset($_COOKIE['language'])){

			if($_COOKIE['language'] == "ua"){$lang = "ua";$locale = "uk_UA";}
			if($_COOKIE['language'] == "ru"){$lang = "ru";$locale = "ru_RU";}
			#"en_JP"
		}

		if(!isset($lang))$lang = "ua";
		if(!isset($locale))$locale = "uk_UA";

		$zl = new Zend_Locale();
		$zl->setLocale($locale);
		Zend_Registry::set('Zend_Locale', $zl);

		$translate = new Zend_Translate('csv', APPLICATION_PATH . '/configs/lang/' . $lang . '.csv');

		Zend_Registry::set('Zend_Translate', $translate);


		$this->bootstrap('FrontController');
		$front = $this->getResource('FrontController');
		$front->setBaseUrl('/' . $lang . '/');

	}


}

