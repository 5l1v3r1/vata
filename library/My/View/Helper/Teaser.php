<?php

class My_View_Helper_Teaser extends Zend_View_Helper_Abstract{

	function teaser($type = 1){

		if($type == 1){

			$content = '
				<div id="adloud-block-40602"></div>
				<script src="http://pre1.adloud.net/block.js"></script>
				<script>
				    Adloud_init({
				        type: \'300x250\',
				        colorScheme: \'black\',
				        backgroundScheme: \'border\',
				        allowAdult: true,
				        allowShock: false,
				        allowSms: true,
				        id: 40602
				    });
				</script>';

		}else{
			$content = '
				<div id="adloud-block-40602"></div>
				<script src="http://pre1.adloud.net/block.js"></script>
				<script>
							Adloud_init({
				        type: \'300x250\',
				        colorScheme: \'black\',
				        backgroundScheme: \'border\',
				        allowAdult: true,
				        allowShock: false,
				        allowSms: true,
				        id: 40602
				    });
				</script>';

		}

		echo $content;

	}

}