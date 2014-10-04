<?php

class Application_Model_DbTable_Images extends Application_Model_DbTable_Abstract
{

	protected $_name = 'images';

	public function getAlbumImages($id, $all = 1, $params = array("img_name"), $cache = 1, $status = null){

		$data = $this   ->select()
						->from($this->_name, $params)
						->where("album_id = ?", $id);

		if(isset($status))$data->where("status = ?", $status);

		return $this->memcachePdo($data, $all, $cache);


	}


}

