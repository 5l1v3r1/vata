<?php

class My_View_Helper_Midali extends Zend_View_Helper_Abstract{

	public function midali($data)
	{

		$string = "";

		if (count($data) < 3) {

			$string .= '<div class="row">';

			foreach ($data as $key => $midal){

				$string .= '<div class="col-sm-3 col-lg-3 col-md-3">';
				$string .= "<img class = 'img-responsive img-thumbnail' alt = '' src='/data/img/design/medals/{$midal["image"]}'>";
				$string .= "</div>";

			}

			$string .= '</div>';

		} else {

			$c = 0;
			$r = 0;


			foreach ($data as $key => $midal){

				if (!($r % 3)) $string .= '<div class="row">';
				$string .= '<div class="col-sm-3 col-lg-3 col-md-3">';
				$string .= "<img class = 'img-responsive img-thumbnail' alt = '' src='/data/img/design/medals/{$midal["image"]}'>";
				$string .= "</div>";

				$c++;
				$r++;

				if (!($r % 3)) $string .= '</div>';

			}
		}

		echo $string;

	}


}