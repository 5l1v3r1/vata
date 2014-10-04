<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 07.03.13
 * Time: 11:06
 * Skype: passika_web
 */

class My_View_Helper_Url extends Zend_View_Helper_Abstract
{

	static public function url($check = null)
	{

		$config = Zend_Registry::get('config');

		if ($check == 1) {
			return $config->baseUrl;
		} else {
			echo $config->baseUrl;
		}

	}
}
