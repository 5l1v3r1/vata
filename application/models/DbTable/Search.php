<?php
/**
 * Created by PhpStorm.
 * User: Pasika
 * Date: 23.11.2014
 * Time: 10:55
 */

class Application_Model_DbTable_Search extends Application_Model_DbTable_Abstract{

	protected $_name = 'search';

	public function checkToSame($request){

		$data = $this   ->select()
						->from($this->_name)
						->where("request = ?", $request);

		return $this->memcachePdo($data, 0, 1);

	}

	public function getSearch(){

		$data = $this   ->select()
						->from($this->_name)
						->where("deleted = 0");

		return $this->memcachePdo($data, 1, 0);

	}

}