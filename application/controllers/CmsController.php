<?php

class CmsController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{

		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_RDFA');

		$newsDb = new Application_Model_DbTable_News();
		$metModel = new Application_Model_Meta();
		$metModel->newsMeta();

		$view["news"] = $newsDb->getArticlesByStatus(1, array("*"), 1);
		$this->view->params = $view;

	}

	public function supportAction()
	{


	}

	public function listAction()
	{

		$newsDb = new Application_Model_DbTable_News();

		$view["approved"] = $newsDb->getArticlesByStatus(1, array("*"), 0);
		$view["pending"] = $newsDb->getArticlesByStatus(0, array("*"), 0);
		$view["identity"] = Zend_Auth::getInstance()->getStorage()->read();

		$this->view->params = $view;

	}

	public function editAction()
	{

		$newsDb = new Application_Model_DbTable_News();
		$resizer     = new My_Resizer();
		$watermark      = new My_Watermark();
		$randomModel      = new Application_Model_Random();
		$amazonModel = new Application_Model_Amazon();

		if($this->getRequest()->isPost()){

			$data = $this->getRequest()->getPost();
			$data["article_updated"] = date('Y-m-d H:i:s');

			if(isset($_FILES["photos"]["name"]) && !empty($_FILES["photos"]["name"])){
				$exstension = end(explode('.', $_FILES["photos"]["name"]));
				if(in_array($exstension, array("gif", "jpeg", "jpg", "png"))) {

					$dir = "./data/img/news/";
					$imgName = basename($_FILES["photos"]["name"]);
					move_uploaded_file($_FILES["photos"]["tmp_name"], $dir . $imgName);

					$new = $randomModel->transliterate(trim($data["article_name"]));
					$new = preg_replace("#[^A-Za-z_]#", "", $new);
					$new = "{$new}.{$exstension}";
					rename($dir.$imgName, $dir.$new);

					$watermark->addWatermark($dir . $new, "LostIvan.com");

					$resizer->load("./data/img/news/{$new}")->fit_to_width(400)->save($dir."s_".$new);
					$amazonModel->goToCloud($imgName, "news");
					$data["article_img"] = basename($new);

				}
			}

			unset($data["photos"]);
			$newsDb->updateItem($data,$this->getRequest()->getParam("id"));

		}

		$view["ckeditor"] = 1;
		$view["article"] = $newsDb->getItem($this->getRequest()->getParam("id"));
		$this->view->params = $view;

	}

	public function createAction()
	{

		$newsDb = new Application_Model_DbTable_News();
		$randomDb = new Application_Model_Random();
		$amazonModel = new Application_Model_Amazon();
		$resizer     = new My_Resizer();
		$watermark      = new My_Watermark();
		$randomModel      = new Application_Model_Random();

		if($this->getRequest()->isPost()){

			$data = $this->getRequest()->getPost();

			$exstension = end(explode('.', $_FILES["photos"]["name"]));

			if(isset($_FILES["photos"]["name"]) && !empty($_FILES["photos"]["name"])){

				if(in_array($exstension, array("gif", "jpeg", "jpg", "png"))) {

					$dir = "./data/img/news/";
					$imgName = basename($_FILES["photos"]["name"]);
					move_uploaded_file($_FILES["photos"]["tmp_name"], $dir . $imgName);

					$new = $randomModel->transliterate(trim($data["article_name"]));
					$new = preg_replace("#[^A-Za-z_]#", "", $new);
					$new = "{$new}.{$exstension}";
					rename($dir.$imgName, $dir.$new);

					$watermark->addWatermark($dir . $new, "LostIvan.com");

					$resizer->load("./data/img/news/{$new}")->fit_to_width(400)->save($dir."s_".$new);
					#$amazonModel->goToCloud($imgName, "news");
					$data["article_img"] = basename($new);

				}
			}


			$data["article_url"] = $randomDb->transliterate($data["article_name"]);
			$data["article_created"] = date('Y-m-d H:i:s');
			$data["status"] = 0;
			unset($data["photos"]);


			$newsDb->createItem($data);
			$this->redirect("/cms/list");

		}

		$view["ckeditor"] = 1;
		$this->view->params = $view;

	}

	public function viewAction()
	{

		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_RDFA');

		$newsDb = new Application_Model_DbTable_News();
		$metModel = new Application_Model_Meta();
		$url = $this->getRequest()->getParam("id");

		$data = $newsDb->getArticleByUrl($url);
		$metModel->articleMeta($data);


		$view["article"] = $data;
		$this->view->params = $view;

	}

	public function previewAction()
	{

		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_RDFA');

		$newsDb = new Application_Model_DbTable_News();
		$metModel = new Application_Model_Meta();
		$url = $this->getRequest()->getParam("id");

		$data = $newsDb->getItem($url);
		$metModel->articleMeta($data);


		$view["article"] = $data;
		$this->view->params = $view;

	}


}