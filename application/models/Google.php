<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 24.07.13
 * Time: 15:09
 * Skype: passika_web
 */

class Application_Model_Google{

    public function getGoogleAnalyticsData($page, $from, $to){

        /*
         * getGoogleAnalyticsData
         *
         * method to get views for some page for some period
         *
         * @param $page (string) page to check
         * @param $from (string) start date
         * @param $to   (string) end date
         *
         * return array of GA data
         *
         */

        require_once 'Google/Google_Client.php';
        require_once 'Google/contrib/Google_AnalyticsService.php';

        $config = Zend_Registry::get('config');

        $client = new Google_Client();
        $client->setApplicationName( 'Analytics' );

        $client->setClientId( $config->analytics->cliendID );
        $client->setAccessType( 'offline_access');

        $client->setAssertionCredentials(
            new Google_AssertionCredentials(
                $config->analytics->email,
                array( 'https://www.googleapis.com/auth/analytics.readonly' ),
                file_get_contents( './google/9c8c62df93603be0e6f9e4d8f6cf06d0697054fb-privatekey.p12' )
            )
        );

        $client->setUseObjects( true );

        $service = new Google_AnalyticsService( $client );

        $results = $service->data_ga->get(

            'ga:75574133',
            $from,
            $to,
            'ga:visits,ga:pageviews',
            array(
                'dimensions' => 'ga:pagePath', 'filters' => 'ga:pagePath=='.$page
            )

        );

        return $results->totalsForAllResults;

    }

    public function GoogleLink(){

        /*
         * GoogleLink
         *
         * method to create link for login with Google API
         *
         */

        require_once 'Google/Google_Client.php';
        $config = Zend_Registry::get('config');

        $gClient = new Google_Client();
        $gClient->setApplicationName('Geoola.com');
        $gClient->setClientId($config->google->appId);
        $gClient->setClientSecret($config->google->api->secret);
        $gClient->setRedirectUri("http://geoola.com/user/google");
        $gClient->setDeveloperKey($config->google->api->key);
        $gClient->setScopes(array("https://www.googleapis.com/auth/userinfo.profile", "https://www.googleapis.com/auth/userinfo.email"));

        return $gClient->createAuthUrl();

    }

    public function getLatLonByAddress($address){

        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $array['lat']  = $response_a->results[0]->geometry->location->lat;
        $array['lng']  = $response_a->results[0]->geometry->location->lng;

        return $array;

    }

}