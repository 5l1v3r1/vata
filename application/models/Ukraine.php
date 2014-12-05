<?php

class Application_Model_Ukraine{

	public function generateDropDown(){

		$oblastDb = new Application_Model_DbTable_Oblast();
		$cityDB = new Application_Model_DbTable_City();
		$terrorDb = new Application_Model_DbTable_Terrorist();

		$obl = $oblastDb->getItemsList();
		foreach($obl as $key => $value){

			$cities = $cityDB->getByOblId($value["id"]);
			foreach($cities as $cKey => $cValue){
				$cities[$cKey]["num"] = $terrorDb->countTerrors($cValue["city"]);
			}
			$obl[$key]["city"] = $cities;
			$obl[$key]["total"] = $terrorDb->countOblTerrors($value["id"]);

		}
		#Zend_Debug::dump($obl);die;
		return $obl;

	}

	public function createUkraineCitiesBase(){

		return false;
		$oblastDb = new Application_Model_DbTable_Oblast();
		$cityDB = new Application_Model_DbTable_City();

		$link = "http://uk.wikipedia.org/wiki/Міста_України_(за_областями)";
		$page = file_get_contents($link);

		$page = substr($page, strpos($page , '<table width="100%">'));
		$page = explode("</table>", $page);
		$page = $page[0];

		preg_match_all("#<tr>(.*?)</tr>#", $this->clear($page), $rows);

		foreach($rows[0] as $key => $value){

			if($key != 0){

				preg_match_all("#<td(.*?)</td>#", $value, $td);

				$city       = trim(preg_replace("#<(.*?)>#", "", $td[0][0]));
				$oblast     = trim(preg_replace("#<(.*?)>#", "", $td[0][1]));
				$population = trim(preg_replace("#<(.*?)>| #", "", $td[0][2]));

				$id = $oblastDb->getByName($oblast);

				if($id){

					$cityDB->createItem(array("oblast_id" => $id["id"], "city" => $city, "population" => $population));

				}else{

					$id = $oblastDb->createItem(array("oblast" => $oblast));
					$cityDB->createItem(array("oblast_id" => $id, "city" => $city));

				}

				unset($id);
				unset($city);
				unset($oblast);
				unset($population);

			}

		}
	}

	function clear($text){

		$this->text = $text;
		$this->text  = preg_replace('/ /','&nbsp;',$this->text);
		$this->text = preg_replace('/\s/','',$this->text);
		$this->text = preg_replace('/&nbsp;/',' ',$this->text);
		return $this->text;

	}

}