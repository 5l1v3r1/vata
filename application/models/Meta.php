<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 04.04.14
 * Time: 17:16
 */

class Application_Model_Meta
{

	public function __construct()
	{

		$this->view = Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer')->view;
		$this->lang = Zend_Registry::get('Zend_Translate');

	}

	public function indexMeta()
	{

		$this->view->headTitle($this->lang->translate("Російські солдати та найманці помічені в Україні"));
		$this->view->headMeta()->setName('description', $this->lang->translate("В нас ви зможете знайти громадян Росії та російських військових які воюють на сході України"));
		$this->view->headMeta()->setName('keywords', $this->lang->translate("Полонені десантники, список пропавших солдат росії, російська армія в Україні, російські солдати в Україні"));
		$this->view->headMeta()->setProperty('og:title', $this->lang->translate("LostIvan: російські солдати і найманці загублені в Україні: "));
		$this->view->headMeta()->setProperty('og:description', $this->lang->translate("База солдат та найманців які були вбиті/полонені/помічені в Україні"));
		#$this->view->headMeta()->setProperty('og:image', My_View_Helper_Url::url(1) . "/data/img/terrorussians/{$data["photo"]}");

	}

	public function IvanMeta($data)
	{

		$data["name"] = "{$data["last_name"]} {$data["first_name"]}";

		$this->view->headTitle($data['name'] . " " . $this->lang->translate($data['type']) . " " . $this->lang->translate($data['status']));
		$this->view->headMeta()->setName('description', $data['name'] . $this->lang->translate(" в Україні."));
		$this->view->headMeta()->setName('keywords', $data['name'] . $this->lang->translate(" в Україні."));
		$this->view->headMeta()->setProperty('og:title', $data['name'] . " " . $this->lang->translate($data['type']) . " " . $this->lang->translate($data['status']));
		$this->view->headMeta()->setProperty('og:description', $this->lang->translate("LostIvan: ") . " " . $data['name'] . " " . preg_replace("#<(.*?)>#", "", $data['description']));
		$this->view->headMeta()->setProperty('og:image', "http://lostivan200.s3.amazonaws.com/{$data["photo"][0]["img_name"]}");

	}

	public function newsMeta(){

		$this->view->headTitle($this->lang->translate("Новини на тему російського вторгнення в Україну"));
		$this->view->headMeta()->setName('description', $this->lang->translate("Світові новини на тему російської агресії проти України"));
		$this->view->headMeta()->setName('keywords', $this->lang->translate("російські війська в Україні, докази присутності російської армії в Україні"));
		$this->view->headMeta()->setProperty('og:title', $this->lang->translate("Новини на тему російського вторгнення в Україну"));
		$this->view->headMeta()->setProperty('og:description', $this->lang->translate("Світові новини на тему російської агресії проти України"));

	}

	public function articleMeta($data){

		$this->view->headTitle($data["article_name"]);
		$this->view->headMeta()->setName('description', $data["article_description"]);
		$this->view->headMeta()->setName('keywords', $this->lang->translate("російські війська в Україні, докази присутності російської армії в Україні"));
		$this->view->headMeta()->setProperty('og:title', $data["article_name"]);
		$this->view->headMeta()->setProperty('og:description',$data["article_description"]);
		$this->view->headMeta()->setProperty('og:image', My_View_Helper_Url::url() . "/data/img/news/{$data["article_img"]}");


	}

}