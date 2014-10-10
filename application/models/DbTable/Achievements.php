<?php


class Application_Model_DbTable_Achievements extends Application_Model_DbTable_Abstract
{


	protected $_name = 'achievements';

	public function getAchievementsByType($type)
	{

		/**
		 * getAchievementsByType method
		 *
		 * return array on actions
		 *
		 * @param  $id (int)   business id
		 * @return     (array) actions array
		 */

		$data = $this->select()
			->from($this->_name, array('id', 'ach_name'))
			->where('business = ? ', $type);

		return $this->memcachePdo($data, 1);

	}

	public function getAchievementsNotIn($in = NULL, $type, $selectors = array('*'))
	{

		/**
		 * getAchievementsNotIn method
		 *
		 * return array achievements not in array
		 *
		 * @param $in (string) business in list
		 * @return    (array) businesses array
		 */

		$data = $this->select()
			->from($this->_name, $selectors)
			->where('business = ?', $type);

		if (!empty($in)) $data->where('id NOT in (?)', $in);

		return $this->memcachePdo($data, 1);

	}

}