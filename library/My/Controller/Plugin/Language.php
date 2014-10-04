<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 01.10.13
 * Time: 13:02
 * Skype: passika_web
 */

class My_Controller_Plugin_Language extends Zend_Controller_Plugin_Abstract
{

	public function preDispatch(Zend_Controller_Request_Abstract $front)
	{

		$lang = "ru";
		$locale = "ru_RU";

		if(isset($_COOKIE['language'])){

			if($_COOKIE['language'] == "ua"){$lang = "ua";$locale = "uk_UA";}
			if($_COOKIE['language'] == "ru"){$lang = "ru";$locale = "ru_RU";}
			if($_COOKIE['language'] == "en"){$lang = "en";$locale = "en_US";}
			if($_COOKIE['language'] == "lv"){$lang = "lv";$locale = "lv_LV";}
			if($_COOKIE['language'] == "ge"){$lang = "ge";$locale = "de_AT";}
			if($_COOKIE['language'] == "it"){$lang = "it";$locale = "it_IT";}
			#"en_JP"

		}

		$zl = new Zend_Locale();
		$zl->setLocale($locale);
		Zend_Registry::set('Zend_Locale', $zl);

		$translate = new Zend_Translate('csv', APPLICATION_PATH . '/configs/lang/' . $lang . '.csv');

		Zend_Registry::set('Zend_Translate', $translate);
	}

}
