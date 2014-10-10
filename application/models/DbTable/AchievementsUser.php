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
					, users.id
					, achievements.total
					, achievements_user.progress
				FROM
					achievements_user
					INNER JOIN achievements
						ON (achievements_user.ach_id = achievements.id)
					INNER JOIN users
						ON (achievements_user.user_id = users.id)
				WHERE (users.id ={$id})
				ORDER BY achievements_user.stat DESC";
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

}