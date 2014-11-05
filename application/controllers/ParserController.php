<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 29.10.2014
 * Time: 12:52
 */

class ParserController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{

		$modelRandom = new Application_Model_Random();

		for($i = 1; $i <= 18; $i++){

			$page = file_get_contents("http://metelyk.org/page/{$i}/");
			$page = $modelRandom->clear($page);
			preg_match_all('#<h1 class="entry-title">(.*?)</a>#', $page, $links);
			die($page);
			Zend_Debug::dump($links);die;
			foreach($links[0] as $value){

				$url = preg_replace('#<a rel="bookmark" href="|"(.*?)</a>', "", $value);
				echo $url . "<br>";

			}
			die;

		}

	}

	public function curlPare(){

	}
}