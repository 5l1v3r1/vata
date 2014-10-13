<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?><form id="qjump" method="get" accept-charset="utf-8" action="http://zend-frameworks.com/zend_forum/viewforum.php">
	<div class="frm-fld frm-select">
		<label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br />
		<span class="frm-input"><select id="qjump-select" name="id">
			<optgroup label="Форуми по Zend Framework">
				<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Базові компоненти</option>
				<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>Model-View-Controller (MVC)</option>
				<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Робота з базами даних</option>
				<option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>Ідентифікація, Аутентифікація, Авторизація, права доступу</option>
				<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Локалізація та інтернаціоналізація</option>
				<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Інші компоненти</option>
				<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>Загальні обговорення на тему zend framework</option>
				<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Zend Framework для новачків</option>
				<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>Zend Framework 2</option>
			</optgroup>
			<optgroup label="Питання з програмування">
				<option value="23"<?php echo ($forum_id == 23) ? ' selected="selected"' : '' ?>>PHP</option>
				<option value="24"<?php echo ($forum_id == 24) ? ' selected="selected"' : '' ?>>MySQL</option>
				<option value="38"<?php echo ($forum_id == 38) ? ' selected="selected"' : '' ?>>Mongo</option>
				<option value="25"<?php echo ($forum_id == 25) ? ' selected="selected"' : '' ?>>Java Script</option>
				<option value="26"<?php echo ($forum_id == 26) ? ' selected="selected"' : '' ?>>CSS</option>
				<option value="35"<?php echo ($forum_id == 35) ? ' selected="selected"' : '' ?>>Контроль версій</option>
				<option value="37"<?php echo ($forum_id == 37) ? ' selected="selected"' : '' ?>>Робота з різними соціальними API системами</option>
			</optgroup>
			<optgroup label="CMS">
				<option value="29"<?php echo ($forum_id == 29) ? ' selected="selected"' : '' ?>>Wordpress</option>
				<option value="30"<?php echo ($forum_id == 30) ? ' selected="selected"' : '' ?>>Joomla</option>
				<option value="31"<?php echo ($forum_id == 31) ? ' selected="selected"' : '' ?>>Magento</option>
				<option value="32"<?php echo ($forum_id == 32) ? ' selected="selected"' : '' ?>>PHP FOX</option>
				<option value="33"<?php echo ($forum_id == 33) ? ' selected="selected"' : '' ?>>Drupal</option>
				<option value="34"<?php echo ($forum_id == 34) ? ' selected="selected"' : '' ?>>Інші</option>
			</optgroup>
			<optgroup label="Інші фреймворки">
				<option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Symfony</option>
				<option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>Symfony2</option>
				<option value="15"<?php echo ($forum_id == 15) ? ' selected="selected"' : '' ?>>Kohana</option>
				<option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>CodeIgniter</option>
				<option value="17"<?php echo ($forum_id == 17) ? ' selected="selected"' : '' ?>>Yii</option>
			</optgroup>
			<optgroup label="Інші">
				<option value="18"<?php echo ($forum_id == 18) ? ' selected="selected"' : '' ?>>ZFConf</option>
				<option value="20"<?php echo ($forum_id == 20) ? ' selected="selected"' : '' ?>>Робота і власні проекти.</option>
				<option value="21"<?php echo ($forum_id == 21) ? ' selected="selected"' : '' ?>>Користувачі - адміністрація - користувачі</option>
				<option value="22"<?php echo ($forum_id == 22) ? ' selected="selected"' : '' ?>>Оффтопік</option>
			</optgroup>
		</select>
		<input type="submit" id="qjump-submit" value="<?php echo $lang_common['Go'] ?>" /></span>
	</div>
</form>
<?php

$forum_javascript_quickjump_code = <<<EOL
(function () {
	var forum_quickjump_url = "http://zend-frameworks.com/zend_forum/viewforum.php?id=$1";
	var sef_friendly_url_array = new Array(31);
	sef_friendly_url_array[2] = "bazov-komponenti";
	sef_friendly_url_array[3] = "modelviewcontroller-mvc";
	sef_friendly_url_array[4] = "robota-z-bazami-danikh";
	sef_friendly_url_array[5] = "dentifkatsya-autentifkatsya-avtorizatsya-prava-dostupu";
	sef_friendly_url_array[6] = "lokalzatsya-ta-nternatsonalzatsya";
	sef_friendly_url_array[7] = "nsh-komponenti";
	sef_friendly_url_array[8] = "zagaln-obgovorennya-na-temu-zend-framework";
	sef_friendly_url_array[9] = "zend-framework-dlya-novachkv";
	sef_friendly_url_array[11] = "zend-framework-2";
	sef_friendly_url_array[23] = "php";
	sef_friendly_url_array[24] = "mysql";
	sef_friendly_url_array[38] = "mongo";
	sef_friendly_url_array[25] = "java-script";
	sef_friendly_url_array[26] = "css";
	sef_friendly_url_array[35] = "kontrol-versi";
	sef_friendly_url_array[37] = "robota-z-rznimi-sotsalnimi-api-sistemami";
	sef_friendly_url_array[29] = "wordpress";
	sef_friendly_url_array[30] = "joomla";
	sef_friendly_url_array[31] = "magento";
	sef_friendly_url_array[32] = "php-fox";
	sef_friendly_url_array[33] = "drupal";
	sef_friendly_url_array[34] = "nsh";
	sef_friendly_url_array[13] = "symfony";
	sef_friendly_url_array[14] = "symfony2";
	sef_friendly_url_array[15] = "kohana";
	sef_friendly_url_array[16] = "codeigniter";
	sef_friendly_url_array[17] = "yii";
	sef_friendly_url_array[18] = "zfconf";
	sef_friendly_url_array[20] = "robota-vlasn-proekti";
	sef_friendly_url_array[21] = "koristuvach-admnstratsya-koristuvach";
	sef_friendly_url_array[22] = "offtopk";

	PUNBB.common.addDOMReadyEvent(function () { PUNBB.common.attachQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array); });
}());
EOL;

$forum_loader->add_js($forum_javascript_quickjump_code, array('type' => 'inline', 'weight' => 60, 'group' => FORUM_JS_GROUP_SYSTEM));
?>
