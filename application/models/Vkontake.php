<?php

class Application_Model_Vkontake
{

	public function vkLogin($code)
	{

		/**
		 * vkLogin
		 *
		 * Method to create user with VK API
		 *
		 * @param  $code  (string) response code
		 */

		$usersDb        = new Application_Model_DbTable_Users();
		$userModel      = new Application_Model_User();
		$randomModel    = new Application_Model_Random();
		$resizerClass = new My_Resizer();

		$config = Zend_Registry::get('config');

		$params = array(

			'client_id' => $config->vk->appId,
			'client_secret' => $config->vk->token,
			'code' => $code,
			'redirect_uri' => $config->vk->url,

		);

		$token = self::vkCurl('https://oauth.vk.com/access_token', $params);

		if (isset($token['access_token'])) {

			$params = array(
				'uids' => $token['user_id'],
				'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,friends',
				'access_token' => $token['access_token']
			);

			$userInfo = self::vkCurl('https://api.vk.com/method/users.get', $params);
			$response = (array)$userInfo["response"]["0"];
			$gender = ($response["sex"] == 2) ? "male" : "female";
			$pass = md5($randomModel->createRandString());
			$avatar = basename($response["photo_big"]);
			$bdate = (isset($response["bdate"])) ? $response["bdate"] : '';

			$account = array(

				"facebook_id" => $response["uid"],
				"first_name" => $response["first_name"],
				"last_name" => $response["last_name"],
				"gender" => $gender,
				"role" => "user",
				"status" => 1,
				"social" => "vk",
				"birthday" => $bdate,
				"pass" => $pass,
				"image" => $avatar,
				"create_date" => date('Y-m-d H:i:s'),
				"update_time" => date('Y-m-d H:i:s'),
				"hashcode" => $randomModel->createRandInt()

			);

			$check = $usersDb->checkById($account["facebook_id"], $userModel::VKONTAKTE);

			$firendsInfo = self::vkCurl('https://api.vk.com/method/friends.get', array('uid' => $response["uid"],'fields'=>'uid'));
			$friends = array();
			foreach($firendsInfo["response"] as $value)$friends[] = $value->uid;

			if ($check) {

				#self::updateUserFriendsList($check['id'], $friends);
				$userModel->login($check['facebook_id'], $check['pass']);

			} else {

				$id = $usersDb->createItem($account);
				#self::updateUserFriendsList($id, $friends);
				$userModel->login($response['uid'], $pass);

			}

		}

	}

	public function vkCurl($url, $params, $token = NULL)
	{

		/**
		 * vkCurl
		 *
		 * Method to get response from vk API
		 *
		 * @param  $url     (string) url for request
		 * @param  $params  (array)  arrays of params for request
		 * @param  $token   (string) token to post on wall
		 *
		 * @return (array) JSON request from API
		 */

		$curl = curl_init();

		$url = $url . '?' . urldecode(http_build_query($params));
		$url = preg_replace("# #", "%20", $url);
		if(isset($token))$url .= "&access_token=" . $token;

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

		$res = (array)json_decode(curl_exec($curl));
		curl_close($curl);
		return $res;

	}

}

