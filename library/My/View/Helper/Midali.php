<?php

class My_View_Helper_Midali extends Zend_View_Helper_Abstract
{

	public function midali($data)
	{

		$string = "";

		$string .= '<div class="row">';
		foreach ($data as $key => $midal) {

			$string .= '<div class="col-sm-2 col-lg-2 col-md-2">';
			$string .= "<img class = 'img-responsive img-thumbnail' alt = '' src='/data/img/design/medals/{$midal["image"]}'>";
			$string .= "</div>";

		}
		$string .= '</div>';


		echo $string;

	}

}