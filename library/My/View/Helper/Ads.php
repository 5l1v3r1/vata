<?php

class My_View_Helper_Ads extends Zend_View_Helper_Abstract{

	function ads(){

		#if(APPLICATION_ENV == "testing") return false;

		$content = '			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- vatakvadrata -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-2839396741829240"
     data-ad-slot="8582441812"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';

		echo $content;

	}

}