<?php

class Application_Model_DbTable_AchievementsUser extends Application_Model_DbTable_Abstract
{

	protected $_name = 'achievements_user';

	public function getUserAchievemnts($id)
	{

		$sql = "SELECT
					achievements.ach_name
					, achievements.ach_desc
					, achievements_user.stat
					, achievements_user.ach_id
					, achievements.image
				FROM
					achievements_user
					INNER JOIN achievements
						ON (achievements_user.ach_id = achievements.id)
					INNER JOIN terrorist
						ON (achievements_user.user_id = terrorist.id)
				WHERE (terrorist.id ={$id})";
		return $this->memcachePdo($sql, 1, 1);

	}

	public function getByUserAndAchId($owner, $id)
	{

		$data = $this->getAdapter()
			->select()
			->from($this->_name, array('id'))
			->where('user_id = ? ', $owner)
			->where('ach_id = ? ', $id);

		return $this->memcachePdo($data, 1);

	}

	public function dropUsetAchievemnts($id){

		$where = $this->getAdapter()->quoteInto('user_id = ?', $id);

		$this->delete($where);

	}

}