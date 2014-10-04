<?php

class Application_Model_User
{

    const FACEBOOK  = "facebook";
    const VKONTAKTE = "vk";
    const GOOGLE    = "google";
    const TWITTER   = "twitter";

    public function login($id, $pass)
    {

        /**
         * login
         *
         * login  method.
         *
         * @param $id (string) user e-mail
         * @param $pass  (string) user password in md5 hash
         * @return (array) user session
         */


        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());

        $authAdapter->setTableName('users')
                    ->setIdentityColumn('facebook_id')
                    ->setCredentialColumn('pass')
                    ->setIdentity($id)
                    ->setCredential($pass);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {

            $identity = $authAdapter->getResultRowObject();
            $authStorage = $auth->getStorage();
            $authStorage->write($identity);

            if ($identity->banned == 1) {

	            Zend_Auth::getInstance()->clearIdentity();
				die("You are banned lostivan200@gmail.com");

            }

            $response['status'] = 'Successes';
            $response['data'] = $identity;

        } else {

            $response['status'] = 'Error';
            return $response;

        }
    }

    public function makeUserDir($id)
    {

        /*
         * makeUserDir
         *
         * method to create user directories for images
         *
         * param $id (int) user id
         *
         * return $directory(string) user base directory
         */

        $directory = self::userImagesDir($id);

        @mkdir($directory);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . '65' . DIRECTORY_SEPARATOR);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . '100' . DIRECTORY_SEPARATOR);
        @mkdir($directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . '240' . DIRECTORY_SEPARATOR);

        return $directory;

    }

    public function userImagesDir($id){

        /*
        * userImagesDir
        *
        * method to get path of users imagse
        *
        * param $id (int) user id
        *
        * return $directory(string) user base directory
        */

        return  'data' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR;

    }

    public function updateUserFriendsList($id, $list){

        /*
        * updateUserFriendsList
        *
        * method to udate user friends list
        *
        * param $id   (int) user id
        * param $list (array) user friends list
        *
        * return $directory(string) user base directory
        */

        $friends = 	new Application_Model_DbTable_Friend();
        $users	 =	new Application_Model_DbTable_Users();

        $usersList = array();
        foreach($users->getItemsList(array("facebook_id")) as $value)$usersList[] = $value['facebook_id'];

        $friends->deleteFriends($id);
        $new = array_intersect($usersList, $list);

        if($new){

            foreach($new as $value){

                $friends->addFriend($id, $value) ;

            }

        }

    }

}

