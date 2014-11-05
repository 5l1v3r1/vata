<?php

class My_View_Helper_Ads extends Zend_View_Helper_Abstract{

	function ads(){

		if(APPLICATION_ENV == "testing") return false;

		$content = '			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<!-- vataclub -->
									<ins class="adsbygoogle"
									     style="display:block"
									     data-ad-client="ca-pub-2839396741829240"
									     data-ad-slot="8722042617"
									     data-ad-format="auto"></ins>
									<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
									</script>';

		echo $content;

	}

}