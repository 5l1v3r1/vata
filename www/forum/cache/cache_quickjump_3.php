<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?><form id="qjump" method="get" accept-charset="utf-8" action="http://vata.club/forum/viewforum.php">
	<div class="frm-fld frm-select">
		<label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br />
		<span class="frm-input"><select id="qjump-select" name="id">
			<optgroup label="Ідентифікація російських оккупантів">
				<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Опізнані террористи</option>
				<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>Ідентифіція террористів</option>
			</optgroup>
			<optgroup label="Сепаратизм в Україні">
				<option value="24"<?php echo ($forum_id == 24) ? ' selected="selected"' : '' ?>>Харківська область</option>
				<option value="17"<?php echo ($forum_id == 17) ? ' selected="selected"' : '' ?>>Львівська область</option>
				<option value="10"<?php echo ($forum_id == 10) ? ' selected="selected"' : '' ?>>Житомирська область</option>
				<option value="25"<?php echo ($forum_id == 25) ? ' selected="selected"' : '' ?>>Херсонська область</option>
				<option value="18"<?php echo ($forum_id == 18) ? ' selected="selected"' : '' ?>>Миколаївська область</option>
				<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>Закарпатська область</option>
				<option value="26"<?php echo ($forum_id == 26) ? ' selected="selected"' : '' ?>>Хмельницька область</option>
				<option value="19"<?php echo ($forum_id == 19) ? ' selected="selected"' : '' ?>>Одеська область</option>
				<option value="12"<?php echo ($forum_id == 12) ? ' selected="selected"' : '' ?>>Запорізька область</option>
				<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Автономна Республіка Крим</option>
				<option value="27"<?php echo ($forum_id == 27) ? ' selected="selected"' : '' ?>>Черкаська область</option>
				<option value="20"<?php echo ($forum_id == 20) ? ' selected="selected"' : '' ?>>Полтавська область</option>
				<option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Івано-Франківська область</option>
				<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Вінницька область</option>
				<option value="28"<?php echo ($forum_id == 28) ? ' selected="selected"' : '' ?>>Чернівецька область</option>
				<option value="21"<?php echo ($forum_id == 21) ? ' selected="selected"' : '' ?>>Рівненська область</option>
				<option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>Київська область</option>
				<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Волинська область</option>
				<option value="29"<?php echo ($forum_id == 29) ? ' selected="selected"' : '' ?>>Чернігівська область</option>
				<option value="22"<?php echo ($forum_id == 22) ? ' selected="selected"' : '' ?>>Сумська область</option>
				<option value="15"<?php echo ($forum_id == 15) ? ' selected="selected"' : '' ?>>Кіровоградська область</option>
				<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>Дніпропетровська область</option>
				<option value="23"<?php echo ($forum_id == 23) ? ' selected="selected"' : '' ?>>Тернопільська область</option>
				<option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>Луганська область</option>
				<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Донецька область</option>
			</optgroup>
			<optgroup label="Оффтоп">
				<option value="30"<?php echo ($forum_id == 30) ? ' selected="selected"' : '' ?>>Спілкування на будь-які теми</option>
			</optgroup>
		</select>
		<input type="submit" id="qjump-submit" value="<?php echo $lang_common['Go'] ?>" /></span>
	</div>
</form>
<?php

$forum_javascript_quickjump_code = <<<EOL
(function () {
	var forum_quickjump_url = "http://vata.club/forum/viewforum.php?id=$1";
	var sef_friendly_url_array = new Array(28);
	sef_friendly_url_array[2] = "opznan-terroristi";
	sef_friendly_url_array[3] = "dentiftsya-terroristv";
	sef_friendly_url_array[24] = "kharkvska-oblast";
	sef_friendly_url_array[17] = "lvvska-oblast";
	sef_friendly_url_array[10] = "zhitomirska-oblast";
	sef_friendly_url_array[25] = "khersonska-oblast";
	sef_friendly_url_array[18] = "mikolayivska-oblast";
	sef_friendly_url_array[11] = "zakarpatska-oblast";
	sef_friendly_url_array[26] = "khmelnitska-oblast";
	sef_friendly_url_array[19] = "odeska-oblast";
	sef_friendly_url_array[12] = "zaporzka-oblast";
	sef_friendly_url_array[4] = "avtonomna-respublka-krim";
	sef_friendly_url_array[27] = "cherkaska-oblast";
	sef_friendly_url_array[20] = "poltavska-oblast";
	sef_friendly_url_array[13] = "vanofrankvska-oblast";
	sef_friendly_url_array[6] = "vnnitska-oblast";
	sef_friendly_url_array[28] = "chernvetska-oblast";
	sef_friendly_url_array[21] = "rvnenska-oblast";
	sef_friendly_url_array[14] = "kiyivska-oblast";
	sef_friendly_url_array[7] = "volinska-oblast";
	sef_friendly_url_array[29] = "cherngvska-oblast";
	sef_friendly_url_array[22] = "sumska-oblast";
	sef_friendly_url_array[15] = "krovogradska-oblast";
	sef_friendly_url_array[8] = "dnpropetrovska-oblast";
	sef_friendly_url_array[23] = "ternoplska-oblast";
	sef_friendly_url_array[16] = "luganska-oblast";
	sef_friendly_url_array[9] = "donetska-oblast";
	sef_friendly_url_array[30] = "splkuvannya-na-budyak-temi";

	PUNBB.common.addDOMReadyEvent(function () { PUNBB.common.attachQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array); });
}());
EOL;

$forum_loader->add_js($forum_javascript_quickjump_code, array('type' => 'inline', 'weight' => 60, 'group' => FORUM_JS_GROUP_SYSTEM));
?>
