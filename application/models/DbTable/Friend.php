 <?php

class Application_Model_DbTable_Friend extends Application_Model_DbTable_Abstract
{
    protected $_name = 'friends';

    public function deleteFriends($id, $live = 0){

        /**
         * addFriend
         *
         * Method for droping user's Facebook friends in a 'friends' table
         *
         * @param $id int
         */

        $this->delete('user_id=' . ((int)$id) . ' and live = '. (int)0);

    }

    public function addFriend($user_id, $friend_id){

        /**
         * addFriend
         *
         * Method for adding user's Facebook friends in a 'friends' table
         *
         * @param $user_id, $friend_id int
         */

        $friends = array(

            'user_id' => $user_id,
            'facebook_id' => $friend_id,
            'pending' => 1,

        );

        $this->insert($friends);

    }

	public function checkToFriends($user, $friend = NULL, $status = NULL, $multi = NULL, $selectors = array("*")){

		/*
		 * method checkToFriends
		 *
		 * method to check is users friends or send request
		 *
		 *
		 * @param $user     (int) user id
		 * @param $friend   (int) friend id
		 */

		$data = $this   ->select()
						->from($this->_name, $selectors)
						->where("user_id = ?", $user);

		if(isset($friend))$data->where("facebook_id = ?", $friend);
		if(isset($status))$data->where("pending = ?", $status);
		if(isset($multi))return $data->query()->fetchAll();

		return $data->query()->fetch();

	}

	public function getPendingRequests($id, $status = 1){

		$data = $this   ->select()
			->from($this->_name)
			->where("user_id= ?", $id)
			->where("pending = ?", $status);

		return $data->query()->fetchAll();

	}

    public function getUserFriends($id, $status = 1){

        $data = $this   ->select()
                        ->from($this->_name)
                        ->where("user_id= ?", $id)
	                    ->where("pending = ?", $status);

	    return $data->query()->fetchAll();

    }

}