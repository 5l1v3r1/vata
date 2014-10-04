<?php

class Application_Model_Facebook
{

	public function auth($data)
	{

		/*
		 * method auth
		 *
		 * method to auth user (login or create new)
		 *
		 * @param $data(array)
		 *
		 * return status
		 *
		 */

		$userDb = new Application_Model_DbTable_Users();
		$userModel = new Application_Model_User();
		$googleModel = new Application_Model_Google();
		$randomModel = new Application_Model_Random();
		$subscribeDb = new Application_Model_DbTable_Subscribe();

		$check = $userDb->checkById($data["id"], $userModel::FACEBOOK);
		if (isset($check["id"])) {

			return $userModel->login($check['facebook_id'], $check['pass']);

		} else {

			if ($data["location"]["name"]) {
				$geolocation = $googleModel->getLatLonByAddress(urlencode($data["location"]["name"]));
				$data["lat"] = $geolocation["lat"];
				$data["lng"] = $geolocation["lng"];
			}

			$data['password'] = $randomModel->createRandString();
			$data['hashcode'] = $randomModel->createRandInt();
			$data['token'] = $randomModel->createRandInt();

			$userDb->createUserByFb($data);
			$subscribeDb->createItem(array("email" => $data["email"], "unsubscribe" => md5($data["email"])));

			return $userModel->login($data['id'], md5($data['password']));

		}


	}

}

