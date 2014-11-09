<?php

class Application_Model_DbTable_News extends Application_Model_DbTable_Abstract
{

	protected $_name = 'news';

	public function getArticlesByStatus($status, $array = array("*"), $cache = 1){

		$data = $this   ->select()
						->from($this->_name, $array)
						->where("status = ?", $status)
						->order("article_created DESC");

			return $this->memcachePdo($data, 1, $cache);

	}

	public function getArticleByUrl($url, $status = 1, $array = array("*"), $cache = 1){

		$url = preg_replace("#[^0-9A-Za-z_]#", "", $url);

		$data = $this   ->select()
						->from($this->_name, $array)
						->where("article_url = ?", $url)
						->where("status = ?", $status);

		return $this->memcachePdo($data, 0, $cache);

	}

	public function getForSocialPosting($social){

		$data = "SELECT * FROM news WHERE status = 1 and {$social} = 0 limit 0, 5";
		return $this->memcachePdo($data, 1, 0);

	}

}

