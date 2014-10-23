<?php

class CronjobController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{

		/*
		 * index
		 *
		 * Method to send emails from website
		 *
		 */

		$notify = new Application_Model_DbTable_Notify();
		$validator = new Zend_Validate_EmailAddress();
		$list = $notify->getActiveList(0, 15);
		$mailerModel = new Application_Model_Mailer();


		if ($list) {

			foreach ($list as $value) {

				$mailer = new My_Mail();
				$mailer->setRecipient($value["email"]);
				$mailer->setTemplate("template");

				foreach ($mailerModel->$value["action"]((array)json_decode($value['vars'])) as $k => $v) {

					$mailer->$k = $v;

				}

				if (!$validator->isValid($value['email'])) $notify->deleteItem($value['id']);
				$mailer->send();
				$notify->deleteItem($value['id']);

			}

		}

	}

	public function subscribeAction(){

		$terrorsDb = new Application_Model_DbTable_Terrorist();
		$subscribeDb = new Application_Model_DbTable_Subscribe();
		$notifyDb = new Application_Model_DbTable_Notify();
		$list = $terrorsDb->getFreshMeat();
		foreach($list as $key => $value)$data["terror"][$key] = $value;
		$data["num"] = count($list);

		if($data["num"] > 0){
			$subscribed = $subscribeDb->getSubscribed();
			foreach($subscribed as $value){

				$data["unsubscribe"] = $value["unsubscribe"];

				$arr = array(

					"email" => $value["email"],
					"vars" => json_encode($data),
					"action" => "subscribe"

				);
				$notifyDb->createItem($arr);

			}
		}


	}

	public function twitterAction()
	{

		/*
		 * twitterAction
		 *
		 * Method to post new reviews in Twitter
		 * Will take reviews for twitter what is checked by admin
		 *
		 * return array of reviews
		 */

		$home = My_View_Helper_Url::url(1);
		$terrorists = new Application_Model_DbTable_Terrorist();
		$newsDb = new Application_Model_DbTable_News();
		$shareModel = new Application_Model_Share();
		$imagesDb = new Application_Model_DbTable_Images();
		$lang = Zend_Registry::get('Zend_Translate');
		$config = Zend_Registry::get('config');

		#businesses
		$list = $terrorists->getForSocialPosting("tw_posted");

		foreach ($list as $value) {

			$link = "{$home}/member/{$value['id']}";
			$img = $imagesDb->getAlbumImages($value["id"], 1, array("img_name"), 0);
			$picture = (isset($img[0]["img_name"])) ? "http://{$config->amazon->bucket}.s3.amazonaws.com/".$img[0]["img_name"] : "http://{$config->amazon->bucket}.s3.amazonaws.com/noimage.jpg" ;

			$post = array(

				"name" => "{$value['last_name']} {$value['first_name']}",
				"text" => "{$lang->translate("Тип")}: {$lang->translate($value['type'])} {$lang->translate("Статус")}: {$lang->translate($value['status'])} {$link} #vatnik #vataclub",
				"img"  => $picture

			);


			$shareModel->twitterPost($post);
			$terrorists->updateItem(array('tw_posted' => '1'), $value['id']);

		}

	}

	public function facebookAction()
	{

		$terrorDb = new Application_Model_DbTable_Terrorist();
		$view["list"] = $terrorDb->getForSocialPosting("fb_posted");

		$this->view->params = $view;
		#actions

	}

	public function vkAction()
	{

		$business = new Application_Model_DbTable_Business();
		$review = new Application_Model_DbTable_Review();
		$actions = new Application_Model_DbTable_Actions();
		$vk = new Application_Model_Users();
		$config = Zend_Registry::get('config');
		$users = new Application_Model_DbTable_Users();

		$list = $review->getItemsForPosting("vk");

		foreach ($list as $value) {

			$bus = $business->getItem($value["business_id"]);
			$user = $users->getItem($value['owner_id']);

			$params = array(
				"owner_id" => $config->vk->poster->userId,
				"attachments" => "http://geoola.com/business/view/" . $bus["url"] . "?review=" . $value["id"],
				"message" => $user['first_name'] . " " . $user['last_name'] . ": Додав(ла) відгук для " . $bus['name']
			);

			$vk->vkCurl("https://api.vk.com/method/wall.post", $params, $config->vk->poster->access);

			$review->updateItem(array('vk' => '1'), $value['id']);

		}

		$list = $business->getItemsForPosting("vk");

		foreach ($list as $value) {

			$params = array(
				"owner_id" => $config->vk->poster->userId,
				"attachments" => "http://geoola.com/business/view/" . $value["url"],
				"message" => preg_replace("#&(.*?);|<(.*?)>#", "", $value["name"]) . " м." . $value["loc_name"] . " додано на Geoola.com"
			);

			$group = array(
				"owner_id" => "-{$config->vk->poster->groudId}",
				"attachments" => "http://geoola.com/business/view/" . $value["url"],
				"message" => preg_replace("#&(.*?);|<(.*?)>#", "", $value["name"]) . " м." . $value["loc_name"] . " додано на Geoola.com",
				"from_group" => 1
			);

			$vk->vkCurl("https://api.vk.com/method/wall.post", $params, $config->vk->poster->access);
			$vk->vkCurl("https://api.vk.com/method/wall.post", $group, $config->vk->poster->access);
			$business->updateItem(array('vk' => '1'), $value['id']);

		}

		#actions
		$list = $actions->getItemsForPosting("vk");

		foreach ($list as $value) {

			$bus = $business->getItem($value["business_id"]);

			$params = array(
				"owner_id" => $config->vk->poster->userId,
				"attachments" => "http://geoola.com/business/view/" . $bus["url"] . "?actions=" . $value["id"],
				"message" => preg_replace("#&(.*?);|<(.*?)>#", "", $bus["name"]) . " м." . $bus["loc_name"] . " розпочинає нову акцію"
			);

			$vk->vkCurl("https://api.vk.com/method/wall.post", $params, $config->vk->poster->access);
			$actions->updateItem(array('vk' => '1'), $value['id']);

		}


	}


	public function sitemapAction()
	{

		/*
		 *
		 * sitemap
		 *
		 * Method to generate sitemap.xml file for search engines
		 *
		 */

		$terroristDb = new Application_Model_DbTable_Terrorist();
		$news = new Application_Model_DbTable_News();
		$home = My_View_Helper_Url::url(1);


		$fp = fopen("./data/sitemap/sitemap.xml", "w+");
		fputs($fp, '<?xml version="1.0" encoding="UTF-8"?>' . chr(13) . chr(10));
		fputs($fp, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . chr(13) . chr(10));

		$lang = array("ua","ru");

		foreach($lang as $l){
			fputs($fp, "<url><loc>{$home}/{$l}</loc><changefreq>daily</changefreq><priority>1.00</priority></url>" . chr(13) . chr(10));

			foreach ($terroristDb->getItemsList() as  $value) {

				fputs($fp, "<url><loc>{$home}/{$l}/member/{$value["id"]}</loc><changefreq>daily</changefreq><priority>0.75</priority> </url>" . chr(13) . chr(10));

			}
		}



		fputs($fp, '</urlset>' . chr(13) . chr(10));
		fclose($fp);

	}

}

