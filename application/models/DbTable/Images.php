<?php

class Application_Model_DbTable_Images extends Application_Model_DbTable_Abstract
{

	protected $_name = 'images';

	public function getAlbumImages($id, $all = 1, $params = array("img_name"), $cache = 1, $status = null){

		$data = $this   ->select()
						->from($this->_name, $params)
						->where("album_id = ?", $id)
						->order("is_main DESC");

		if(isset($status))$data->where("status = ?", $status);

		return $this->memcachePdo($data, $all, $cache);


	}

	public function checkToMain($albumId){

			$data = $this   ->select()
							->from($this->_name)
							->where("album_id = ?", $albumId)
							->where("is_main = ?", 1);

		return $this->memcachePdo($data, 0, 1);
	}

	public function updateIsMain($status, $id){

		$where[] = $this->getAdapter()->quoteInto('album_id = ?', $id);
		$array = array("is_main" => $status);
		$this->update($array, $where);

	}


}

