<?php

class My_View_Helper_Lang extends Zend_View_Helper_Abstract{

	function lang(){

		$lang = array();

		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "en"){$lang["type"] = "en";$lang["name"] = "English";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "ua"){$lang["type"] = "ua";$lang["name"] = "Українська";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "pl"){$lang["type"] = "pl";$lang["name"] = "Polskie";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "lv"){$lang["type"] = "lv";$lang["name"] = "Latviešu";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "ge"){$lang["type"] = "ge";$lang["name"] = "Deutsch";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "it"){$lang["type"] = "it";$lang["name"] = "Italiano";}
		if(isset($_COOKIE["language"]) && $_COOKIE["language"] == "lt"){$lang["type"] = "lt";$lang["name"] = "Lithuanian";}
		if((isset($_COOKIE["language"]) && $_COOKIE["language"] == "ru") || !isset($_COOKIE["language"])){$lang["type"] = "ru";$lang["name"] = "Русский";}

		return $lang;

	}

}