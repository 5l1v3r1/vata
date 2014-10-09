<?php

class AlbumController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function createAction()
	{

		$terroristDb    = new Application_Model_DbTable_Terrorist();
		$imagesDb       = new Application_Model_DbTable_Images();
		$userModel      = new Application_Model_Random();
		$amazonModel    = new Application_Model_Amazon();
		$notify         = new Application_Model_DbTable_Notify();
		$identity       = Zend_Auth::getInstance()->getStorage()->read();
		$watermark      = new My_Watermark();
		$resizerClass   = new My_Resizer();



		if($this->getRequest()->isPost()){

			$params = $this->getRequest()->getPost();
			$params["owner_id"] = $identity->id;
			$params["create_date"] = date('Y-m-d H:i:s');
			$params["checked"] = 0;


			$id = $terroristDb->createItem($params);

			$pic["owner_id"] = $identity->id;
			$pic["album_id"] = $id;

			$dir = './data/img/vata/';

			$images = $_FILES;

			$c = 1;
			foreach ($images["photos"]["name"] as $key => $value) {

				$pic["img_name"] = basename($images["photos"]["name"][$key]);
				$tmp = $images["photos"]["tmp_name"][$key];
				$exstension = end(explode('.', $pic["img_name"]));

				if (in_array($exstension, array("gif", "jpeg", "jpg", "png"))) {

					move_uploaded_file($tmp, $dir . $pic["img_name"]);

					$new = $userModel->transliterate(trim("{$params["last_name"]}_{$params["first_name"]}"));
					$new = preg_replace("#[^A-Za-z_]#", "", $new);
					$new = "{$new}_{$c}_.{$exstension}";
					rename($dir . $pic["img_name"], $dir . $new);
					$pic["img_name"] = $new;
					#$watermark->addWatermark($dir . $new, "LostIvan.com");
					$resizerClass->load($dir . $new)->best_fit(400, 400)->save("{$dir}small_{$new}");
					#$watermark->addWatermark("{$dir}small_{$new}", "Vata.Club");
					$amazonModel->goToCloud($new);
					$amazonModel->goToCloud("small_{$new}");
					$imagesDb->createItem($pic);

				}

				$c++;

			}

			if($identity->role != "admin"){


				$vars = array(

					"username" => "{$params["last_name"]}_{$params["first_name"]}",
					"header" => "Додано нового Івана",

				);

				$arr = array(

					"email" => "lostivan200@gmail.com",
					"vars" => json_encode($vars),
					"action" => "create"

				);

				$notify->createItem($arr);

				$arr["email"] = "lost.ivan@bk.ru";
				$notify->createItem($arr);


			}

			$this->redirect("/?infosend=1");

		}
	}

	public function viewAction()
	{

		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_RDFA');

		$terroristDb = new Application_Model_DbTable_Terrorist();
		$imagesDb = new Application_Model_DbTable_Images();
		$identity       = Zend_Auth::getInstance()->getStorage()->read();

		$metaModel = new Application_Model_Meta();

		$id = $this->getRequest()->getParam("id");

		$ivan = $terroristDb->getByIdAndStatus($id);
		if(!$ivan)$this->redirect("/error/");
		$meat = (!isset($identity->id)) ? 1 : null;

		$images = $imagesDb->getAlbumImages($id, 1, array("img_name", "id"),1, $meat);
		$closed = $imagesDb->getAlbumImages($id, 1, array("img_name", "id"),1, 0);
		$closed = (count($closed) > 0 && !isset($identity->id)) ? 1 : null;

		$ivan["photo"] = $images;
		$view["closed"] = $closed;

		$view["terrorist"] = $ivan;
		$view["images"] = $images;
		$view["identity"] = (isset($identity->id)) ? $identity : null;
		$view["fancybox"] = 1;
		$metaModel->IvanMeta($ivan);

		$this->view->params = $view;

	}

	public function editAction(){

		$terroristDb = new Application_Model_DbTable_Terrorist();
		$imagesDb = new Application_Model_DbTable_Images();
		$amazonModel = new Application_Model_Amazon();
		$randomModel = new Application_Model_Random();
		$watermark = new My_Watermark();
		$usersDb = new Application_Model_DbTable_Users();
		$resizerClass = new My_Resizer();
		$oblastDb = new Application_Model_DbTable_Oblast();
		$cityDb = new Application_Model_DbTable_City();

		$id = $this->getRequest()->getParam("id");

		if($this->getRequest()->isPost()){

			$params = $this->getRequest()->getPost();
			$terroristDb->updateItem($params, $id);

			$pic["owner_id"] = $params["owner_id"];
			$pic["album_id"] = $id;

			$dir = './data/img/vata/';

			$images = $_FILES;

			$c = rand(99,9999);
			foreach($images["photos"]["name"] as $key => $value){

				$pic["img_name"] = basename($images["photos"]["name"][$key]);
				$tmp = $images["photos"]["tmp_name"][$key];
				$exstension = end(explode('.', $pic["img_name"]));

				if(in_array($exstension, array("gif", "jpeg", "jpg", "png"))){

					move_uploaded_file($tmp, $dir . $pic["img_name"]);


					$new = $randomModel->transliterate(trim("{$params["last_name"]}_{$params["first_name"]}"));
					$new = preg_replace("#[^A-Za-z_]#", "", $new);
					$new = "{$new}_{$c}_.{$exstension}";
					rename($dir.$pic["img_name"], $dir.$new);

					$pic["img_name"] = $new;
					#$watermark->addWatermark($dir . $new, "Vata.Club");
					$resizerClass->load($dir . $new)->best_fit(400, 400)->save("{$dir}small_{$new}");
					#$watermark->addWatermark("{$dir}small_{$new}", "Vata.Club");
					$amazonModel->goToCloud($new);
					$amazonModel->goToCloud("small_{$new}");

					$imagesDb->createItem($pic);

				}

				$c++;

			}

		}

		$terror = $terroristDb->getTerrorist($id);

		$view["terrorist"] = $terror;
		$view["publisher"] = $usersDb->getItem($terror["owner_id"]);
		$view["images"] = $imagesDb->getAlbumImages($id, 1, array("img_name", "id", "is_main"), 0);
		$view["fancybox"] = 1;
		$view["crop"] = 1;
		$view["ckeditor"] = 1;
		$view["oblast"] = $oblastDb->getItemsList();
		$view["city"] = $cityDb->getItemsList();

		$this->view->params = $view;

	}

	public function proposeAction(){

		if($this->getRequest()->isPost()){

			$identity = Zend_Auth::getInstance()->getStorage()->read();
			$notify = new Application_Model_DbTable_Notify();

			$params = $this->getRequest()->getPost();
			$params["proposer"] = $identity->id;

			$arr = array(

				"email" => "lostivan200@gmail.com",
				"vars" => json_encode($params),
				"action" => "edit"

			);

			$notify->createItem($arr);
			$this->redirect("/?editsend=1");

		}

	}

}

