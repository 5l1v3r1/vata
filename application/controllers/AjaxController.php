<?php

class AjaxController extends Zend_Controller_Action
{

	public function init()
	{
		$this->_helper->AjaxContext()
			->addActionContext('index', 'json')
			->addActionContext('album', 'json')
			->addActionContext('user', 'json')
			->initContext('json');
	}

	public function indexAction()
	{
		$post = $this->getRequest()->getParams();

		if (isset($post["urlsaver"])) {

			$_SESSION["urlsaver"] = $post["urlsaver"];
			return true;

		}

		if(isset($post["language"])){

			$url = preg_replace("/ua|ru|en|ge|it|lv|pl|lt/", $post["language"], $post["page"]);
			setcookie("language",$post["language"],time()+31556926 ,'/');
			$this->view->link = $url;

		}
	}

	public function userAction()
	{
		$usersDb = new Application_Model_DbTable_Users();
		$cityDb = new Application_Model_DbTable_City();
		$imagesDb = new Application_Model_DbTable_Images();
		$amazonModel = new Application_Model_Amazon();
		$random = new My_Resizer();
		$this->lang = Zend_Registry::get('Zend_Translate');

		$post = $this->getRequest()->getParams();
		if (isset($post["banUser"])) $usersDb->updateItem(array("banned" => 1), $post["banUser"]);
		if (isset($post["mainImg"])) {

			$imagesDb->updateItem(array("is_main" => 1), $post["mainImg"]);

			$img = $imagesDb->getItem($post["mainImg"]);
			$this->view->img = "/data/img/vata/small_{$img["img_name"]}";

		}

		if (isset($post["imageCrop"])) {

			$name = basename($post["imageCrop"]);
			$dir = "./data/img/vata/";
			unlink("{$dir}crop_{$name}");
			$random->load("{$dir}{$name}")->crop($post["x1"], $post["y1"], $post["x2"], $post["y2"])->save("{$dir}crop_{$name}");
			$amazonModel->goToCloud("crop_small_{$name}");

		}

		if (isset($post["getCityByObl"])) {

			$option = "<option value = ''>{$this->lang->translate("Область")}</option>";
			foreach($cityDb->getByOblId($post["getCityByObl"]) as $value){
				$option.="<option value = '{$value["id"]}'>{$value["city"]}</option>";
			}
			$this->view->city = $option;
		}
	}

	public function albumAction()
	{

		$albumDb = new Application_Model_DbTable_Terrorist();
		$newsDb = new Application_Model_DbTable_News();
		$imagesDb = new Application_Model_DbTable_Images();
		$notify = new Application_Model_DbTable_Notify();

		$post = $this->getRequest()->getParams();

		if (isset($post["dropAlbum"])) $albumDb->updateItem(array("checked" => 2), $post["dropAlbum"]);
		if (isset($post["dropArticle"])) $newsDb->updateItem(array("status" => 2), $post["dropArticle"]);
		if (isset($post["approveArticle"])) $newsDb->updateItem(array("status" => 1), $post["approveArticle"]);
		if (isset($post["dropImg"])) $imagesDb->deleteItem($post["dropImg"]);
		if (isset($post["dropFacebook"])) $albumDb->updateItem(array("fb_posted" => 1), $post["dropFacebook"]);
		if (isset($post["saveAlbum"])){$albumDb->updateItem(array("checked" => 1), $post["saveAlbum"]);}

		if (isset($post["propose"])){

			$arr = array(

				"email" => "lostivan200@gmail.com",
				"vars" => json_encode($post),
				"action" => "propose"

			);

			$notify->createItem($arr);

		}

	}


}





