<?php

class Application_Model_DbTable_Users extends Application_Model_DbTable_Abstract
{

	protected $_name = 'users';

	public function checkById($id, $social = NULL)
	{

		/**
		 * checkById
		 *
		 * Get user information by e-mail
		 *
		 * @param $email (string) user mail
		 * @param $social (string) type of social network
		 * @return (array) user data
		 */

		$data = $this   ->select()
						->from('users', array('id', 'first_name', 'last_name', 'pass', 'facebook_id', 'image'))
						->where('facebook_id = ?', $id);

		if ($social) $data->where('social=?', $social);

		return $data->query()->fetch();

	}

	public function createUserByFb($data)
	{

		/**
		 * createUserByFb
		 *
		 * Creting user by facebook login
		 *
		 * @param  $data (array) data received from facebook API
		 */

		$array = array(

			'email' => $data['email'],
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'gender' => $data['gender'],
			'birthday' => $data['birthday'],
			'facebook_id' => $data['id'],
			'image' => $data['id'] . '.jpg',
			'role' => 'user',
			'social' => 'facebook',
			'create_date' => date('Y-m-d H:i:s'),
			'update_time' => date('Y-m-d H:i:s'),
			'pass' => md5($data['password']),
			'hashcode' => $data['hashcode'],
			'status' => 1,

		);

		$this->insert($array);

	}

	public function getUsersByStatus($status = 0)
	{
		$data = $this   ->select()
						->from('users', array('id', 'first_name', 'last_name', 'social', 'facebook_id', 'image'))
						->where('banned = ?', $status);

		return $this->memcachePdo($data, 1, 0);
	}

}

