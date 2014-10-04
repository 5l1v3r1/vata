<?php

abstract class Application_Model_DbTable_Abstract extends Zend_Db_Table_Abstract
{

	public function __construct($config = array())
	{
		parent::__construct($config);

		if (Zend_Db_Table_Abstract::getDefaultMetadataCache() === null)
		{
			$frontendOptions = array('automatic_serialization' => true);

			$zendCacheDir = './data/cache/'; // directory for caching

			if (!file_exists($zendCacheDir))
			{
				mkdir($zendCacheDir, 0777);
			}

			$backendOptions  = array('cache_dir' => $zendCacheDir);

			$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
			Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
		}
	}


	public function getItem($id, $array = array('*'), $cached = 1){

		/*
		* getItem method
		*
		* Method for receiving object by id
		*
		* @param  $id       (int)   object id
		* @param  $array    (array) array of fields to select
		*
		* @return (array) object data
		*/


		$data = $this   ->getAdapter()
						->select()
						->from($this->_name, $array)
						->where('id = ? ' , $id);

	    return $this->memcachePdo($data, 0, $cached);

    }

    public function getItemsList($fields = "*"){

        /*
        * getItemsList method
        *
        * Method for receiving list of objects
        *
        * @params $fields (array) name of fields to return
        * @return (array) objects data list array
        */

        #return $this->fetchAll()->toArray();

		$data = $this   ->select()
						->from($this->_name, $fields);

	    return $this->memcachePdo($data, 1, 1);

    }

    public function createItem($data)
    {

        $this->insert($data);
        return $this->getAdapter()->lastInsertId();

    }

    public function deleteItem($id)
    {

        $where = $this->getAdapter()->quoteInto('id = ?', $id);

        $this->delete($where);

    }

    public function updateItem($data,$id)
    {

        /*
        * updateItem method
        *
        * Method to delete form DB by id
        *
        * @param $id   (int)   object id
        * @param $data (array) data to update
        */

        $where = $this->getAdapter()->quoteInto('id = ?', (int)$id);
        return $this->update($data, $where);


    }

	public function memcachePdo($data, $all = 1, $cacheMe = 1){

		/*
		* memcachePdo method
		*
		* Method to read from cache or from db data
		*
		* @param $data 		(obj)   query data
		* @param $all 		(int)   all or one
		* @param $cacheMe   (int)   get from cache or not
		* @param $sql 		(int)   text sql ot obj data
		*/

		$base = $this->getAdapter()->query($data);

		$cacheMe = (APPLICATION_ENV != "testing") ? $cacheMe : 0;
		if($cacheMe == 0)return ($all == 0) ? $base->fetch() : $base->fetchAll();

		$cache = Zend_Registry::get('cache');
		$key = md5($data);
		$result = $cache->load($key);

		if ($result === false) {

			$result = ($all == 0) ? $base->fetch() : $base->fetchAll();
			$cache->save($result, $key);

		}
		return $result;

	}

}