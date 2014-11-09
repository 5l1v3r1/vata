<?php

class Application_Model_Achievements
{

	public function achievementToUserRelation($data)
	{

		/*
		 * achievementToUserRelation method
		 *
		 * Method to set relations between businesses and users and
		 * update existing relation
		 *
		 * @params $data(array) array with relations data
		 */

		$achievementsUser = new Application_Model_DbTable_AchievementsUser();
		$achievementTable = new Application_Model_DbTable_Achievements();

	}

	public function assignAchievementsToUser($rate)
	{

		$achievementsUser = new Application_Model_DbTable_AchievementsUser();
		$achievementTable = new Application_Model_DbTable_Achievements();


	}


}