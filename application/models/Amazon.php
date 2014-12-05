<?php

class Application_Model_Amazon
{

	public function goToCloud($name, $folder = "vata"){

		if(APPLICATION_ENV == "testing") return true;

		$config = Zend_Registry::get('config');
		$amazon = new Amazon_S3($config->amazon->AccessKeyID, $config->amazon->SecretAccessKey);
		$bucket = $config->amazon->bucket;
		$amazon->putBucket($config->amazon->bucket, Amazon_S3::ACL_PUBLIC_READ);
		$result = $amazon->putObjectFile("./data/img/{$folder}/{$name}", $bucket , $name, Amazon_S3::ACL_PUBLIC_READ);
	}

	public function dropFromCloud($name){

		if(APPLICATION_ENV == "testing") return true;

		$config = Zend_Registry::get('config');
		$amazon = new Amazon_S3($config->amazon->AccessKeyID, $config->amazon->SecretAccessKey);
		$bucket = $config->amazon->bucket;
		$result = $amazon->deleteObject($bucket, $name);

	}

	public function putAllToCloud($dir = "./data/img/vata/"){

		if(APPLICATION_ENV == "testing") return true;

		if ($handle = opendir($dir)) {

			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..")$this->goToCloud($entry);
			}

			closedir($handle);
		}

	}

}