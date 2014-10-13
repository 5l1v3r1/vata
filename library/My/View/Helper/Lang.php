<?php

class My_View_Helper_Lang extends Zend_View_Helper_Abstract{

	function lang(){

		$lang = array();

		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "ru"){$lang["type"] = "ru";$lang["name"] = "Русский";}
		if((isset($_COOKIE["language"]) && $_COOKIE["language"] == "ua") || !isset($_COOKIE["language"])){$lang["type"] = "ua";$lang["name"] = "Українська";}

		return $lang;

	}

}