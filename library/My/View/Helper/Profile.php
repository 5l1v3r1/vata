<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 28.09.2014
 * Time: 11:58
 */

class My_View_Helper_Profile extends Zend_View_Helper_Abstract{

	public function profile($social){

		switch ($social) {
			case "vk":
				$baselink = "http://vk.com/id";
				break;
			case "fb":
				$baselink = "http://facebook.com/profile.php?id=";
				break;
			default:
				$baselink = "";
		}
		return $baselink;

	}

}