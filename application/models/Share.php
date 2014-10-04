<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 14.07.13
 * Time: 20:04
 * Skype: passika_web
 */

class Application_Model_Share
{

	public function __construct()
	{

		$this->config = Zend_Registry::get('config');
		$this->lang = Zend_Registry::get('Zend_Translate');

	}

	public function reviewShareOnFb($facebook_id, $data)
	{

		/*
		 * reviewShareOnFb
		 *
		 * method to share review on facebook
		 *
		 * @param $facebook_id      (int)   owner id
		 * @param $data             (array) review data
		 */

		$attachment = array(

			'message' => 'Додано новий відгук',
			'name' => $data['name'],
			'caption' => "",
			'link' => $data['link'] . '?review=' . $data['id'],
			'description' => $data['review'],
			'picture' => $data['image']

		);

		$facebook = new Facebook_Facebook(array(

			'appId' => $this->config->facebook->appId,
			'secret' => $this->config->facebook->token,

		));

		$isGranted = $facebook->api(array(

			"method" => "users.hasAppPermission",
			"ext_perm" => "publish_stream",
			"uid" => $facebook_id

		));

		if ($isGranted === "1") {

			$me = (isset($facebook_id)) ? $facebook_id : '100006480415423';
			$facebook->api('/' . $me . '/feed/', 'post', $attachment);

		}

	}

	public function twitterPost($data)
	{

		/*
		 * twitterPost
		 *
		 * method to post with twitter API
		 *
		 */

		$connection = new Twitter_TwitterOAuthMod(
			$this->config->twitter->apiKey,
			$this->config->twitter->apiSecret,
			$this->config->twitter->accessToken,
			$this->config->twitter->accessTokenSecret
		);

		$connection->post('statuses/update_with_media', array('media[]' => file_get_contents($data["img"]), 'status' => "{$data["name"]}: {$data["text"]}"), true);

	}

	public function postToWallOnFb($data, $facebook_id)
	{

		/*
		 * postToWallOnFb
		 *
		 * method to post on wall API
		 *
		 */

		$attachment = array(

			'picture' => $data['image'],
			'message' => $data['message'],
			'name' => $data['name'],
			'caption' => $data['caption'],
			'link' => $data['link'],
			'description' => $data['description']

		);

		$facebook = new Facebook_Facebook(array(

			'appId' => $this->config->facebook->appId,
			'secret' => $this->config->facebook->token,

		));

		$isGranted = $facebook->api(array(
			"method" => "users.hasAppPermission",
			"ext_perm" => "publish_stream",
			"uid" => $facebook_id
		));

		if ($isGranted === "1") {

			$me = (isset($facebook_id)) ? $facebook_id : '100006480415423';
			$facebook->api('/' . $me . '/feed/', 'post', $attachment);
			#$facebook->api('/639056129449264/feed/', 'post', $attachment);

		}

	}


}
