<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 29.09.2014
 * Time: 15:24
 */

class Application_Model_DbTable_Oblast  extends Application_Model_DbTable_Abstract{

	protected $_name = 'oblast';

	public function getByName($name){

		$data = $this   ->select()
						->from($this->_name)
						->where("oblast = ?", $name);

		return $this->memcachePdo($data, 0, 1);

	}

}