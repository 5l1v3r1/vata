<?php
class Application_Model_Twitter
{

    public function twSign($data = null)
    {

        /**
         * twSign
         *
         * Method to create user with Twitter API
         *
         * @param  $data (array) response
         */

        $config = Zend_Registry::get('config');
        $user = new Application_Model_Users();

        if ($data){

            #TODO check on mozzila login error
            #if (!empty($data) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){

            $twitteroauth = new Twitter_TwitterOAuth($config->twitter->consumer_key, $config->twitter->consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            // Let's request the access token
            $access_token = $twitteroauth->getAccessToken($data);
            // Save it in a session var
            $_SESSION['access_token'] = $access_token;
            // Let's get the user's info
            $user_info = $twitteroauth->get('account/verify_credentials');
            // Print user's info

            $user->twitterSign((array)$user_info);

            #}else{

            #die('Something wrong happened.');

            #}

        }else{

            // The TwitterOAuth instance
            $twitteroauth = new Twitter_TwitterOAuth($config->twitter->consumer_key, $config->twitter->consumer_secret);
            // Requesting authentication tokens, the parameter is the URL we will be redirected to
            $request_token = $twitteroauth->getRequestToken($config->twitter->url);

            // Saving them into the session
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

            // If everything goes well..
            if($twitteroauth->http_code == 200){

                // Let's generate the URL and redirect
                $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
                header('Location: ' . $url);

            }else{

                #TODO create good error handler or LOG
                #die('Something wrong happened.');

            }
        }
    }
}