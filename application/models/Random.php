<?php

class Application_Model_Random
{

	public function createRandString($length = 8)
	{

		/*
		 * createRandString method
		 *
		 * Generate default string
		 *
		 * param $lenght  (int) length
		 * return $new (string) new string
		 *
		 */

		$new = '';
		$date = date('His');
		srand((double)microtime() * 1000000);
		$char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char_list .= "abcdefghijklmnopqrstuvwxyz";
		$char_list .= "1234567890";

		for ($i = 0; $i < $length; $i++) {

			$new .= substr($char_list, (rand() % (strlen($char_list))), 1);

		}

		return $date . $new;

	}

	public function createRandInt($num = 10)
	{

		/*
		 * createRandName method
		 *
		 * Generate default name for image
		 *
		 * param $old  (string) old name
		 * return $new (string) new name
		 *
		 */

		$new = '';
		$date = date('Ymd');
		srand((double)microtime() * 1000000);
		$char_list = "1234567890";

		for ($i = 0; $i < $num; $i++) {

			$new .= substr($char_list, (rand() % (strlen($char_list))), 1);

		}

		return $new . $date;

	}

	public function createRandName($old)
	{

		/*
		 * createRandName method
		 *
		 * Generate default name for image
		 *
		 * param $old  (string) old name
		 * return $new (string) new name
		 *
		 */

		$new = '';
		$date = date('YmdHis');

		srand((double)microtime() * 1000000);
		$char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char_list .= "abcdefghijklmnopqrstuvwxyz";
		$char_list .= "1234567890";

		for ($i = 0; $i < 10; $i++) {

			$new .= substr($char_list, (rand() % (strlen($char_list))), 1);

		}

		$array = explode('.', $old);
		$ext = strtolower(end($array));

		return "{$date}{$new}.{$ext}";

	}

	function transliterate($input)
	{
		$gost = array(" " => "_", "Ї" => "ji", "И" => "u", "Є" => "YE", "І" => "I", "Ѓ" => "G", "і" => "i", "№" => "n", "є" => "ye", "ѓ" => "g", "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "YO", "Ж" => "ZH", "З" => "Z", "И" => "I", "Й" => "J", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "X", "Ц" => "C", "Ч" => "CH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "'", "Ы" => "Y", "Ь" => "", "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "zh", "з" => "z", "и" => "i", "й" => "j", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "x", "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "shh", "ъ" => "", "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", "ї" => "ji", " " => "_", "—" => "_", "," => "_", "!" => "_", "@" => "_", "#" => "", "$" => "", "%" => "", "^" => "", "&" => "", "*" => "", "(" => "", ")" => "", "+" => "", "=" => "", ";" => "", ":" => "", "'" => "", '"' => "", "~" => "", "`" => "", "?" => "", "/" => "", "\\" => "", "[" => "", "]" => "", "{" => "", "}" => "", "|" => "", "." => "", "," => "", "quot" => "", "-" => "", '®' => '', '™' => '', "%" => "", '’' => '', '‘' => '', "”" => "", "“" => "");
		return strtr(trim($input), $gost);
	}

	public function resizeThemAll(){

		$dir = "./data/img/terrorussians/";
		$resizerClass   = new My_Resizer();
		$watermark      = new My_Watermark();

		if ($handle = opendir($dir)) {

			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".."){

					$resizerClass->load($dir.$entry)->fit_to_width(450)->save($dir."small_".$entry);
					$watermark->addWatermark($dir."small_".$entry, "LostIvan.com");

				}
			}

			closedir($handle);
		}

	}

	public function moveAllToForum(){

		$regions = array(
			"58" => "4",
			"59" => "6",
			"60" => "7",
			"61" => "8",
			"62" => "9",
			"63" => "10",
			"64" => "11",
			"65" => "12",
			"66" => "13",
			"68" => "14",
			"69" => "15",
			"70" => "16",
			"71" => "17",
			"72" => "18",
			"73" => "19",
			"74" => "20",
			"75" => "21",
			"77" => "22",
			"78" => "23",
			"79" => "24",
			"80" => "25",
			"81" => "26",
			"82" => "27",
			"83" => "28",
			"84" => "29",
		);

		$terroristDb = new Application_Model_DbTable_Terrorist();
		$forumTopics = new Application_Model_DbTable_ForumTopics();

		$activeList = $terroristDb->getTerrorists(1);

		foreach($activeList as $key => $value){
			if($key > 1) {
				$data = array(

					"poster" => "Reptiloid",
					"subject" => "{$value["last_name"]} {$value["first_name"]}",
					"forum_id" => $regions[$value["oblast"]]
				);

				$forumTopics->createItem($data);
				die;
			}

		}


	}


}

