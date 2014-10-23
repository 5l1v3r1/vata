<?php

class Application_Model_DbTable_Terrorist extends Application_Model_DbTable_Abstract
{

	protected $_name = 'terrorist';

	public function getFreshMeat(){

		$data = $this   ->select()
						->from($this->_name)
						->where("checked = 1")
						->where("create_date > ?", date('Y-m-d 00:00:00'));

		return $data->query()->fetchAll();

	}

	public function getTerrorist($id){

		$data = "SELECT terrorist.*, oblast.id AS oblId, city.id AS cityId FROM terrorist JOIN oblast JOIN city WHERE terrorist.oblast = oblast.id AND terrorist.city = city.id AND terrorist.id = {$id}";
		return $this->memcachePdo($data, 0, 1);
	}

    public function getByIdAndStatus($id, $status = 1){

	    $id = (int)$id;
	    $data = "SELECT terrorist.*, oblast.oblast AS oblname, city.city AS cityname,  oblast.id AS oblId, city.id AS cityId  FROM terrorist JOIN oblast JOIN city WHERE terrorist.oblast = oblast.id AND terrorist.city = city.id AND terrorist.id = {$id} AND terrorist.checked = {$status}";

	    return $this->memcachePdo($data, 0, 1);

    }

	public function getTerrorists($checked, $start = 0, $step = 10, $cache = 1, $type = null, $status = null, $more = null)
	{

		/**
		 * getUserAlbums
		 *
		 * Get user albums list or one album
		 *
		 * @param $email (string) user mail
		 * @param $social (string) type of social network
		 * @return (array) user data
		 */

		if(isset($type)){
			if($type == 1)$type = "AND type = 'Найманці з Росії'";
			if($type == 2)$type = "AND type = 'Російські військові'";
		}else $type = "";

		if(isset($status)){
			if($status == 1)$status = "AND status = 'Вбитий'";
			if($status == 2)$status = "AND status = 'Полонений'";
			if($status == 3)$status = "AND status = 'Помічений в Україні'";
			if($status == 4)$status = "AND status = 'Можливо був в Україні'";
		}else $status = "";

		if(isset($more)){
			if($more == 1)$more = "AND video != ''";
			if($more == 2)$more = "AND (description like '%нацис%' OR description like '%фашис%')";
		}else $more = "";

		$data = "SELECT id, first_name, last_name, oblast, description FROM terrorist  WHERE checked = {$checked} {$type} {$status} {$more} ORDER BY terrorist.id DESC LIMIT {$start}, {$step};";
		return $this->memcachePdo($data, 1, $cache);

	}

	public function getForSocialPosting($social){

		$data = "SELECT * FROM terrorist  WHERE checked = 1 and {$social} = 0 limit 0, 5";
		return $this->memcachePdo($data, 1, 0);

	}

	public function getSameName($name){

		$data = $this   ->select()
						->from($this->_name)
						->where("name = ?", $name);

		return $this->memcachePdo($data, 1, 1);

	}

	public function findTerrorists($in)
	{

		$in = implode(",", $in);
		$data = "SELECT
	                    terrorist.*,
	                    images.img_name
	                FROM
	                    images
	                    INNER JOIN terrorist
	                        ON (images.album_id = terrorist.id)
	                WHERE checked = 1
	                AND terrorist.id IN ({$in})
	                GROUP BY terrorist.id
	                ORDER BY terrorist.name ASC;";

		return $this->memcachePdo($data, 1, 1);

	}

	public function vataInDaClub($city, $start, $step){

		$data = "SELECT terrorist.* FROM terrorist JOIN city WHERE city.city = '{$city}' AND terrorist.city = city.id AND checked = 1 ORDER BY terrorist.id DESC LIMIT {$start}, {$step};";
		return $this->memcachePdo($data, 1, 1);

	}

	public function countAllTerrors(){

		$data = "SELECT COUNT(*) as num FROM terrorist WHERE checked = 1";
		return $this->memcachePdo($data, 0, 1);
	}

	public function countTerrors($city){

		$city = addslashes($city);
		$data = "SELECT COUNT(*) as num FROM terrorist JOIN city WHERE city.city = '{$city}' AND checked = 1 AND terrorist.city = city.id";
		return $this->memcachePdo($data, 0, 1);
	}

	public function countOblTerrors($obl){

		$obl = addslashes($obl);
		$data = "SELECT COUNT(*) as num FROM terrorist JOIN oblast WHERE oblast.id = '{$obl}' AND checked = 1 AND terrorist.oblast = oblast.id";
		return $this->memcachePdo($data, 0, 1);
	}


}
