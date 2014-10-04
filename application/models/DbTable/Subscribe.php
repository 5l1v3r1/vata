<?php

class Application_Model_DbTable_Subscribe extends Application_Model_DbTable_Abstract{

	protected $_name = 'subscribe';

	public function getSubscribed(){

		$data = "SELECT * FROM subscribe";
		return $this->memcachePdo($data, 1, 0);

	}

	public function unsubscribe($hashcode){

		$db = $this->getAdapter();
		$where = $db->quoteInto('unsubscribe = ?', $hashcode);
		$db->delete($this->_name, $where);

	}

}