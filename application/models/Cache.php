<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 05.06.14
 * Time: 11:30
 */

class Application_Model_Cache
{

	public function clearCache(){

		$memcache = new Memcache;
		$memcache->connect('localhost', 11211) or die ("Could not connect");
		foreach($this->getKeys(1) as $key => $value){

			if(preg_match("#vata#", $value))$memcache->delete($value);

		}

	}

	public function getKeys($return = 0){

		$memcache = new Memcache;
		$memcache->connect('localhost', 11211) or die ("Could not connect");
		$slabs = $memcache->getExtendedStats('slabs');
		foreach ($slabs as $serverSlabs) {
			foreach ($serverSlabs as $slabId => $slabMeta) {
				try {
					$cacheDump = $memcache->getExtendedStats('cachedump', (int) $slabId, 1000);
				} catch (Exception $e) {
					continue;
				}

				if (!is_array($cacheDump)) {
					continue;
				}

				foreach ($cacheDump as $dump) {

					if (!is_array($dump)) {
						continue;
					}

					foreach ($dump as $key => $value) {
						if(preg_match("#vata#", $key))$keysFound[] = $key;

						if (count($keysFound) == 10000) {
							return $keysFound;
						}
					}
				}
			}
		}

		#$cache = Zend_Registry::get('cache');
		#$cache->setLifetime(300);
		#$cache->save("yoyko", "yoyko");
		if($return == 1)return $keysFound;
		Zend_Debug::dump($keysFound);

	}

}