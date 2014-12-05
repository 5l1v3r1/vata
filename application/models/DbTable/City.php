<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 29.09.2014
 * Time: 15:24
 */

class Application_Model_DbTable_City extends Application_Model_DbTable_Abstract{

	protected $_name = 'city';

	public function getByOblId($id){

		$data = $this   ->select()
						->from($this->_name)
						->where("oblast_id = ?", $id);

		return $this->memcachePdo($data, 1, 1);

	}

}