<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{

		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if(preg_match("#www#", $actual_link)){
			$actual_link = preg_replace("/www\./", "", $actual_link);
			$this->redirect($actual_link, array('code'=>301));
		}

		#$random = new Application_Model_Random();
		#$random->moveAllToForum();
		#die;

		$doctypeHelper = new Zend_View_Helper_Doctype();
		$doctypeHelper->doctype('XHTML1_RDFA');

		$terrorDb   = new Application_Model_DbTable_Terrorist();
		$imagesDb = new Application_Model_DbTable_Images();
		$metaModel  = new Application_Model_Meta();
		$subscribeDb = new Application_Model_DbTable_Subscribe();
		$ukraineModel = new Application_Model_Ukraine();
		$mailerModel = new Application_Model_Mailer();

		$metaModel->indexMeta();
		if(isset($_GET["unsubscribe"]))$subscribeDb->unsubscribe(addslashes($_GET["unsubscribe"]));
		if($this->getRequest()->isPost())$mailerModel->subscribeForNews($this->getRequest()->getPost());

		$city = $this->getRequest()->getParam("city");
		$step = 12;
		$page = $this->getRequest()->getParam("page");
		$start = (isset($page) && $page != 1) ? ($page - 1) * $step : 0;

		if($city){

			$list = $terrorDb->vataInDaClub($city, $start, $step);
			$total = $terrorDb->countTerrors($city);

		}else{

			$total = $terrorDb->countAllTerrors();
			$list = $terrorDb->getTerrorists(1, $start, $step, 1);

		}

		foreach($list as $key => $value){$list[$key]["img"] = $imagesDb->getAlbumImages($value["id"], 0, array("img_name"), 1, 1);}

		$view["numOfPages"] = ceil($total["num"] / $step);
		$view["total"] = $total["num"];
		$view["ckeditor"] = 1;
		$view["terrorists"] = $list;
		$view["curentPage"] = (isset($page)) ?  $page : 1 ;
		$view["cities"] = $ukraineModel->generateDropDown();

		$this->view->params = $view;

	}


}

