<?php
/**
 * Created by PhpStorm.
 * User: Passika
 * Date: 29.08.14
 * Time: 12:04
 */

class SearchController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction(){

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
		$terroristDb = new Application_Model_DbTable_Terrorist();

		$path = realpath('./data/lucene');
		$index = Zend_Search_Lucene::open($path);
		$searchString = trim($this->getRequest()->getParam('query'));
		$hits = $index->find($searchString);
		$ukraineModel = new Application_Model_Ukraine();

		$in = array();

		foreach($hits as $value){

			$in[] = $value->terror;

		}

		$list = array();
		if($in)$list = $terroristDb->findTerrorists($in);
		$view["terrorists"] = $list;
		$view["cities"] = $ukraineModel->generateDropDown();


		$this->view->params = $view;

	}

	public function reindexAction()
	{

		/**
		 * reindexAction
		 *
		 * method to reindex data
		 *
		 */

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
		$terrorsDb = new Application_Model_DbTable_Terrorist();
		#створюємо шлях для файлів індексу таблиць
		@mkdir('./data');
		@mkdir('./data/lucene');

		$index = Zend_Search_Lucene::create('./data/lucene');
		$data = $terrorsDb->getTerrorists(1, 0, 10000);

		foreach($data as $value)
		{

			$doc = new Zend_Search_Lucene_Document();

			$doc->addField(Zend_Search_Lucene_Field::Text('terror', $value['id'], 'UTF-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('name', "{$value['first_name']} {$value['last_name']}", 'UTF-8'));

			$index->addDocument($doc);

		}

		echo count($data);

	}


}