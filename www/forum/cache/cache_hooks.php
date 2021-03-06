<?php

define('FORUM_HOOKS_LOADED', 1);

$forum_hooks = array (
  'ft_js_include' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

switch ($forum_config[\'o_pun_jquery_include_method\'])
			{
				case PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN:
					$ext_pun_jquery_url = \'//ajax.googleapis.com/ajax/libs/jquery/\'.PUN_JQUERY_VERSION.\'/jquery.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN:
					$ext_pun_jquery_url = \'//ajax.aspnetcdn.com/ajax/jQuery/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN:
					$ext_pun_jquery_url = \'//code.jquery.com/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_LOCAL:
				default:
					$ext_pun_jquery_url = $ext_info[\'url\'].\'/js/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;
			}

			$forum_loader->add_js($ext_pun_jquery_url, array(\'type\' => \'url\', \'async\' => false, \'weight\' => 75));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ((isset($vote_results) || isset($vote_form)) && ($cur_post[\'id\'] == $cur_topic[\'first_post_id\'])) {
				$pun_poll_block = \'\';
				if (!empty($vote_form)) {
					$pun_poll_block	.= $vote_form;
				}
				$pun_poll_block	.= $vote_results;

				if (isset($forum_page[\'message\'][\'edited\'])) {
					array_insert($forum_page[\'message\'], \'edited\', $pun_poll_block, \'pun_poll\');
				} else if (isset($forum_page[\'message\'][\'signature\'])) {
					array_insert($forum_page[\'message\'], \'signature\', $pun_poll_block, \'pun_poll\');
				} else {
					$forum_page[\'message\'][\'pun_poll\'] = $pun_poll_block;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'hd_head' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Incuding styles for pun_pm
			if (defined(\'FORUM_PAGE\') && \'pun_pm\' == substr(FORUM_PAGE, 0, 6))
			{
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_pm.min.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_pm.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_pm.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'] && ((FORUM_PAGE == \'viewtopic\' && $forum_config[\'o_quickpost\']) || in_array(FORUM_PAGE, array(\'post\', \'postedit\', \'pun_pm-write\', \'pun_pm-inbox\', \'pun_pm-compose\'))))
			{
				if (!defined(\'FORUM_PARSER_LOADED\'))
					require FORUM_ROOT.\'include/parser.php\';

				// Load CSS
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));

				// CSS for disabled JS hide bar
				$forum_loader->add_css(\'#pun_bbcode_bar { display: none; }\', array(\'type\' => \'inline\', \'noscript\' => true));

				// Load JS
				$forum_loader->add_js(\'PUNBB.pun_bbcode=(function(){return{init:function(){return true;},insert_text:function(d,h){var g,f,e=(document.all)?document.all.req_message:((document.getElementById("afocus")!==null)?(document.getElementById("afocus").req_message):(document.getElementsByName("req_message")[0]));if(!e){return false;}if(document.selection&&document.selection.createRange){e.focus();g=document.selection.createRange();g.text=d+g.text+h;e.focus();}else{if(e.selectionStart||e.selectionStart===0){var c=e.selectionStart,b=e.selectionEnd,a=e.scrollTop;e.value=e.value.substring(0,c)+d+e.value.substring(c,b)+h+e.value.substring(b,e.value.length);if(d.charAt(d.length-2)==="="){e.selectionStart=(c+d.length-1);}else{if(c===b){e.selectionStart=b+d.length;}else{e.selectionStart=b+d.length+h.length;}}e.selectionEnd=e.selectionStart;e.scrollTop=a;e.focus();}else{e.value+=d+h;e.focus();}}}};}());PUNBB.common.addDOMReadyEvent(PUNBB.pun_bbcode.init);\', array(\'type\' => \'inline\'));

				($hook = get_hook(\'pun_bbcode_styles_loaded\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				require FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\';
				$forum_loader->add_css($pun_colored_usergroups_cache, array(\'type\' => \'inline\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_stop_spam.css\')) {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_stop_spam.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			} else {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_stop_spam.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mi_new_action' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'pun_pm_send\' && !$forum_user[\'is_guest\'])
{
	if(!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
		require $ext_info[\'path\'].\'/functions.php\';

	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	$pun_pm_body = isset($_POST[\'req_message\']) ? $_POST[\'req_message\'] : \'\';
	$pun_pm_subject = isset($_POST[\'pm_subject\']) ? $_POST[\'pm_subject\'] : \'\';
	$pun_pm_receiver_username = isset($_POST[\'pm_receiver\']) ? $_POST[\'pm_receiver\'] : \'\';
	$pun_pm_message_id = isset($_POST[\'message_id\']) ? (int) $_POST[\'message_id\'] : false;

	if (isset($_POST[\'send_action\']) && in_array($_POST[\'send_action\'], array(\'send\', \'draft\', \'delete\', \'preview\')))
		$pun_pm_send_action = $_POST[\'send_action\'];
	elseif (isset($_POST[\'pm_draft\']))
		$pun_pm_send_action = \'draft\';
	elseif (isset($_POST[\'pm_send\']))
		$pun_pm_send_action = \'send\';
	elseif (isset($_POST[\'pm_delete\']))
		$pun_pm_send_action = \'delete\';
	else
		$pun_pm_send_action = \'preview\';

	($hook = get_hook(\'pun_pm_after_send_action_set\')) ? eval($hook) : null;

	if ($pun_pm_send_action == \'draft\')
	{
		// Try to save the message as draft
		// Inside this function will be a redirect, if everything is ok
		$pun_pm_errors = pun_pm_save_message($pun_pm_body, $pun_pm_subject, $pun_pm_receiver_username, $pun_pm_message_id);
		// Remember $pun_pm_message_id = false; inside this function if $pun_pm_message_id is incorrect

		// Well... Go processing errors

		// We need no preview
		$pun_pm_msg_preview = false;
	}
	elseif ($pun_pm_send_action == \'send\')
	{
		// Try to send the message
		// Inside this function will be a redirect, if everything is ok
		$pun_pm_errors = pun_pm_send_message($pun_pm_body, $pun_pm_subject, $pun_pm_receiver_username, $pun_pm_message_id);
		// Remember $pun_pm_message_id = false; inside this function if $pun_pm_message_id is incorrect

		// Well... Go processing errors

		// We need no preview
		$pun_pm_msg_preview = false;
	}
	elseif ($pun_pm_send_action == \'delete\' && $pun_pm_message_id !== false)
	{
		pun_pm_delete_from_outbox(array($pun_pm_message_id));
		redirect(forum_link($forum_url[\'pun_pm_outbox\']), $lang_pun_pm[\'Message deleted\']);
	}
	elseif ($pun_pm_send_action == \'preview\')
	{
		// Preview message
		$pun_pm_errors = array();
		$pun_pm_msg_preview = pun_pm_preview($pun_pm_receiver_username, $pun_pm_subject, $pun_pm_body, $pun_pm_errors);
	}

	($hook = get_hook(\'pun_pm_new_send_action\')) ? eval($hook) : null;

	$pun_pm_page_text = pun_pm_send_form($pun_pm_receiver_username, $pun_pm_subject, $pun_pm_body, $pun_pm_message_id, false, false, $pun_pm_msg_preview);

	// Setup navigation menu
	$forum_page[\'main_menu\'] = array(
		\'inbox\'		=> \'<li class="first-item"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'"><span>\'.$lang_pun_pm[\'Inbox\'].\'</span></a></li>\',
		\'outbox\'	=> \'<li><a href="\'.forum_link($forum_url[\'pun_pm_outbox\']).\'"><span>\'.$lang_pun_pm[\'Outbox\'].\'</span></a></li>\',
		\'write\'		=> \'<li class="active"><a href="\'.forum_link($forum_url[\'pun_pm_write\']).\'"><span>\'.$lang_pun_pm[\'Compose message\'].\'</span></a></li>\',
	);

	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_pun_pm[\'Private messages\'], forum_link($forum_url[\'pun_pm\'])),
		array($lang_pun_pm[\'Compose message\'], forum_link($forum_url[\'pun_pm_write\']))
	);

	($hook = get_hook(\'pun_pm_pre_send_output\')) ? eval($hook) : null;

	define(\'FORUM_PAGE\', \'pun_pm-write\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	echo $pun_pm_page_text;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

$section = isset($_GET[\'section\']) ? $_GET[\'section\'] : null;

if ($section == \'pun_pm\' && !$forum_user[\'is_guest\'])
{
	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	if (!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
		require $ext_info[\'path\'].\'/functions.php\';

	$pun_pm_page = isset($_GET[\'pmpage\']) ? $_GET[\'pmpage\'] : \'\';

	($hook = get_hook(\'pun_pm_pre_page_building\')) ? eval($hook) : null;

	// pun_pm_get_page() performs everything :)
	// Remember $pun_pm_page correction inside pun_pm_get_page() if this variable is incorrect
	$pun_pm_page_text = pun_pm_get_page($pun_pm_page);

	// Setup navigation menu
	$forum_page[\'main_menu\'] = array(
		\'inbox\'		=> \'<li class="first-item\'.($pun_pm_page == \'inbox\' ? \' active\' : \'\').\'"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'"><span>\'.$lang_pun_pm[\'Inbox\'].\'</span></a></li>\',
		\'outbox\'	=> \'<li\'.(($pun_pm_page == \'outbox\') ? \' class="active"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm_outbox\']).\'"><span>\'.$lang_pun_pm[\'Outbox\'].\'</span></a></li>\',
		\'write\'		=> \'<li\'.(($pun_pm_page == \'write\' || $pun_pm_page == \'compose\') ? \' class="active"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm_write\']).\'"><span>\'.$lang_pun_pm[\'Compose message\'].\'</span></a></li>\',
	);

	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_pun_pm[\'Private messages\'], forum_link($forum_url[\'pun_pm\']))
	);

	if ($pun_pm_page == \'inbox\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Inbox\'], forum_link($forum_url[\'pun_pm_inbox\']));
	else if ($pun_pm_page == \'outbox\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Outbox\'], forum_link($forum_url[\'pun_pm_outbox\']));
	else if ($pun_pm_page == \'write\' || $pun_pm_page == \'compose\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Compose message\'], forum_link($forum_url[\'pun_pm_write\']));

	($hook = get_hook(\'pun_pm_pre_page_output\')) ? eval($hook) : null;

	define(\'FORUM_PAGE\', \'pun_pm-\'.$pun_pm_page);
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	echo $pun_pm_page_text;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'crumbs\'] = array(
	array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
);
App::route();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'news\')
			{
				$pun_forum_news_query = array(
					\'SELECT\'	=>	\'post_id\',
					\'FROM\'		=>	\'pun_forum_news AS news\',
					\'JOINS\'		=>	array(
						array(
							\'LEFT JOIN\'	=> \'forum_perms AS fp\',
							\'ON\'		=> \'(fp.forum_id = news.forum_id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=>	\'(fp.read_forum IS NULL OR fp.read_forum = 1)\',
					\'ORDER BY\'	=>	\'news.posted DESC\'
				);
				$pun_forum_news_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

				$no_news = FALSE;
				$post_news_id = array();

				while ($cur_news = $forum_db->fetch_assoc($pun_forum_news_result))
					$post_news_id[] = $cur_news[\'post_id\'];

				if (count($post_news_id) > 0)
				{
					$news_count = count($post_news_id);
					$forum_page[\'num_pages\'] = ceil($news_count / $forum_user[\'disp_posts\']);
					$forum_page[\'page\'] = (!isset($_GET[\'p\']) || !is_numeric($_GET[\'p\']) || $_GET[\'p\'] <= 1 || $_GET[\'p\'] > $forum_page[\'num_pages\']) ? 1 : $_GET[\'p\'];
					$forum_page[\'start_from\'] = $forum_user[\'disp_posts\'] * ($forum_page[\'page\'] - 1);
					$forum_page[\'finish_at\'] = min(($forum_page[\'start_from\'] + $forum_user[\'disp_posts\']), ($news_count + 1));
					$forum_page[\'items_info\'] =  generate_items_info($lang_pun_forum_news[\'Forum news\'], ($forum_page[\'start_from\'] + 1), $news_count);

					$post_news_id = array_slice($post_news_id, $forum_page[\'start_from\'], $forum_page[\'finish_at\']);
					$pun_forum_news_query = array(
						\'SELECT\'	=>	\'news.*, u.avatar, u.avatar_width, u.avatar_height\',
						\'FROM\'		=>	\'pun_forum_news AS news\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'users AS u\',
								\'ON\'			=> \'u.id=news.poster_id\'
							),
						),
						\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $post_news_id).\')\'
					);
					$query_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

					$posts_info = array();
					while ($cur_post = $forum_db->fetch_assoc($query_result))
					{
						$tmp_index = array_search($cur_post[\'post_id\'], $post_news_id);
						$posts_info[$tmp_index] = $cur_post;
					}
					ksort($posts_info);
					unset($post_news_id);
				}
				else
					$no_news = TRUE;

				if ($no_news)
					message($lang_pun_forum_news[\'No news\']);

				if ($forum_page[\'page\'] < $forum_page[\'num_pages\'])
				{
					$forum_page[\'nav\'][\'last\'] = \'<link rel="last" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], $forum_page[\'num_pages\']).\'" title="\'.$lang_common[\'Page\'].\' \'.$forum_page[\'num_pages\'].\'" />\';
					$forum_page[\'nav\'][\'next\'] = \'<link rel="next" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], ($forum_page[\'page\'] + 1)).\'" title="\'.$lang_common[\'Page\'].\' \'.($forum_page[\'page\'] + 1).\'" />\';
				}
				if ($forum_page[\'page\'] > 1)
				{
					$forum_page[\'nav\'][\'prev\'] = \'<link rel="prev" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], ($forum_page[\'page\'] - 1)).\'" title="\'.$lang_common[\'Page\'].\' \'.($forum_page[\'page\'] - 1).\'" />\';
					$forum_page[\'nav\'][\'first\'] = \'<link rel="first" href="\'.forum_link($forum_url[\'pun_forum_news\']).\'" title="\'.$lang_common[\'Page\'].\' 1" />\';
				}

				// Generate paging and posting links
				$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'pun_forum_news\'], $lang_common[\'Paging separator\']).\'</p>\';

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					$lang_pun_forum_news[\'Forum news\']
				);
				require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/topic.php\';
				require FORUM_ROOT.\'include/parser.php\';

				$user_data_cache = array();

				define(\'FORUM_PAGE\', \'news\');
				require FORUM_ROOT.\'header.php\';
				// START SUBST - <!-- forum_main -->
				ob_start();

				?>
				<div class="main-head">
					<p class="options"><span class="feed first-item"><a class="feed" href="<?php echo forum_link($forum_url[\'pun_forum_news_rss\']); ?>"><?php echo $lang_pun_forum_news[\'RSS news feed\']; ?></a></span></p>
					<h2 class="hn"><span><?php echo $forum_page[\'items_info\'] ?></span></h2>
				</div>
				<div class="main-content main-topic">
				<?php

				$forum_page[\'item_count\'] = 0;
				$author_data_cache = array();
				foreach ($posts_info as $post_num => $post_info)
				{
					$forum_page[\'item_count\']++;
					$forum_page[\'author_ident\'] = $forum_page[\'message\'] = array();


					$forum_page[\'post_ident\'][\'link\'] = \'<span class="post-link"><a class="permalink" rel="bookmark" title="\'.$lang_topic[\'Permalink post\'].\'" href="\'.forum_link($forum_url[\'post\'], $post_info[\'post_id\']).\'">\'.format_time($post_info[\'posted\']).\'</a></span>\';

					if (isset($author_data_cache[$post_info[\'poster_id\']]))
						$forum_page[\'post_ident\'][\'author\'] = $author_data_cache[$post_info[\'poster_id\']][\'name\'];
					else
					{
						if ($forum_user[\'g_view_users\'] == \'1\')
							$forum_page[\'post_ident\'][\'author\'] = \'<span class="post-byline"><a title="\'.sprintf($lang_topic[\'Go to profile\'], forum_htmlencode($post_info[\'poster\'])).\'" href="\'.forum_link($forum_url[\'user\'], $post_info[\'poster_id\']).\'">\'.forum_htmlencode($post_info[\'poster\']).\'</a></span>\';
						else
							$forum_page[\'post_ident\'][\'author\'] = \'<span class="post-byline"><strong>\'.forum_htmlencode($post_info[\'poster\']).\'</strong></span>\';

						$author_data_cache[$post_info[\'poster_id\']][\'name\'] = $forum_page[\'post_ident\'][\'author\'];
					}

					if (isset($author_data_cache[$post_info[\'poster_id\']][\'avatar\']))
					{
						if (!empty($author_data_cache[$post_info[\'poster_id\']][\'avatar\']))
							$forum_page[\'author_ident\'][\'avatar\'] = $author_data_cache[$post_info[\'poster_id\']][\'avatar\'];
					}
					else
					{
						if ($post_info[\'poster_id\'] > 1)
						{
							if ($forum_config[\'o_avatars\'] == \'1\' && $forum_user[\'show_avatars\'] != \'0\')
							{
								$forum_page[\'avatar_markup\'] = generate_avatar_markup($post_info[\'poster_id\'], $post_info[\'avatar\'], $post_info[\'avatar_width\'], $post_info[\'avatar_height\']);

								if (!empty($forum_page[\'avatar_markup\']))
								{
									$forum_page[\'author_ident\'][\'avatar\'] = \'<li class="useravatar">\'.$forum_page[\'avatar_markup\'].\'</li>\';
									$author_data_cache[$post_info[\'poster_id\']][\'avatar\'] = $forum_page[\'author_ident\'][\'avatar\'];
								}
								else
									$author_data_cache[$post_info[\'poster_id\']][\'avatar\'] = \'\';
							}
						}
					}

					// Give the post some class
					$forum_page[\'item_status\'] = array(
						\'post\',
						($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\'
					);

					if ($forum_page[\'item_count\'] == 1)
						$forum_page[\'item_status\'][\'firstpost\'] = \'firstpost\';

					if (($forum_page[\'start_from\'] + $forum_page[\'item_count\']) == $forum_page[\'finish_at\'])
						$forum_page[\'item_status\'][\'lastpost\'] = \'lastpost\';

					// Perform the main parsing of the message (BBCode, smilies, censor words etc)
					$forum_page[\'message\'][\'message\'] = parse_message($post_info[\'message\'], $post_info[\'hide_smilies\']);

					if ($forum_config[\'o_censoring\'] == \'1\')
						$forum_page[\'message\'][\'message\'] = censor_words($forum_page[\'message\'][\'message\']);

			?>
					<div class="<?php echo implode(\' \', $forum_page[\'item_status\']) ?>">
						<div id="p<?php echo $post_info[\'post_id\'] ?>" class="posthead">
							<h3 class="hn post-ident"><?php echo implode(\' \', $forum_page[\'post_ident\']) ?></h3>
						</div>
						<div class="postbody">
							<div class="post-author">
								<ul class="author-ident">
									<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'author_ident\'])."\\n" ?>
								</ul>
							</div>
							<div class="post-entry">
								<div class="entry-content">
									<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'message\'])."\\n" ?>
								</div>
							</div>
						</div>
					</div>
			<?php

				}

				?>
				</div>
				<div class="main-foot">
					<h2 class="hn"><span><?php echo $forum_page[\'items_info\'] ?></span></h2>
				</div>

				<?php

				$tpl_temp = forum_trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
				ob_end_clean();
				// END SUBST - <!-- forum_main -->

				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  're_rewrite_rules' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^pun_pm[\\/_-]?send(\\.html?|\\/)?$/i\'] = \'misc.php?action=pun_pm_send\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?compose[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=compose&receiver_id=$1\';
			$forum_rewrite_rules[\'/^pun_pm(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)[\\/_-]?(p|page\\/)([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1&p=$3\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1&message_id=$2\';

			($hook = get_hook(\'pun_pm_after_rewrite_rules_set\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/url/rewrite_rule.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^news(\\.php?|\\/)?(.html?|\\/)?$/i\'] = \'misc.php?action=news\';
			$forum_rewrite_rules[\'/^news(\\.php?|\\/)?[\\/_\\-?]?p(age)?[\\/_\\-=]?([0-9]+)?(.html?|\\/)?$/i\'] = \'misc.php?action=news&p=$3\';
			$forum_rewrite_rules[\'/^feed[\\/_-]?(rss|atom)[\\/_-]?news[\\/_-]?(\\.xml?|\\/)?$/i\'] = \'extern.php?action=news&type=$1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'hd_visit_elements' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// \'New messages (N)\' link
			if (!$forum_user[\'is_guest\'] && $forum_config[\'o_pun_pm_show_new_count\'])
			{
				global $lang_pun_pm;

				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				// TODO: Do not include all functions, divide them into 2 files
				if(!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
					require $ext_info[\'path\'].\'/functions.php\';

				($hook = get_hook(\'pun_pm_hd_visit_elements_pre_change\')) ? eval($hook) : null;

				//$visit_elements[\'<!-- forum_visit -->\'] = preg_replace(\'#(<p id="visit-links" class="options">.*?)(</p>)#\', \'$1 <span><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'">\'.pun_pm_unread_messages().\'</a></span>$2\', $visit_elements[\'<!-- forum_visit -->\']);
				if ($forum_user[\'g_read_board\'] == \'1\' && $forum_user[\'g_search\'] == \'1\')
				{
					$visit_links[\'pun_pm\'] = \'<span id="visit-pun_pm"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'">\'.pun_pm_unread_messages().\'</a></span>\';
				}

				($hook = get_hook(\'pun_pm_hd_visit_elements_after_change\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_delete_user_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query = array(
				\'DELETE\'	=> \'pun_pm_messages\',
				\'WHERE\'		=> \'receiver_id = \'.$user_id.\' AND deleted_by_sender = 1\'
			);
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			$query = array(
				\'UPDATE\'	=> \'pun_pm_messages\',
				\'SET\'		=> \'deleted_by_receiver = 1\',
				\'WHERE\'		=> \'receiver_id = \'.$user_id
			);
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'co_modify_url_scheme' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_sef\'] != \'Default\' && file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
                require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
            else
                require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_sef\'] == \'Default\')
			{
				$forum_url[\'pun_forum_news\'] = \'misc.php?action=news\';
				$forum_url[\'pun_forum_news_page\'] = \'p=$1\';
				$forum_url[\'pun_forum_news_rss\'] = \'extern.php?action=news&amp;type=rss\';
			}
			else if ($forum_config[\'o_sef\'] == \'File_based\' || $forum_config[\'o_sef\'] == \'File_based_(fancy)\')
			{
				$forum_url[\'pun_forum_news\'] = \'news.html\';
				$forum_url[\'pun_forum_news_page\'] = \'p$1\';
				$forum_url[\'pun_forum_news_rss\'] = \'feed-rss-news.xml\';
			}
			else if ($forum_config[\'o_sef\'] == \'Folder_based\' || $forum_config[\'o_sef\'] == \'Folder_based_(fancy)\')
			{
				$forum_url[\'pun_forum_news\'] = \'news/\';
				$forum_url[\'pun_forum_news_page\'] = \'page/$1/\';
				$forum_url[\'pun_forum_news_rss\'] = \'feed/rss/news/\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'pun_pm_inbox_size\'] = (!isset($form[\'pun_pm_inbox_size\']) || (int) $form[\'pun_pm_inbox_size\'] <= 0) ? \'0\' : (string)(int) $form[\'pun_pm_inbox_size\'];
			$form[\'pun_pm_outbox_size\'] = (!isset($form[\'pun_pm_outbox_size\']) || (int) $form[\'pun_pm_outbox_size\'] <= 0) ? \'0\' : (string)(int) $form[\'pun_pm_outbox_size\'];

			if (!isset($form[\'pun_pm_show_new_count\']) || $form[\'pun_pm_show_new_count\'] != \'1\')
				$form[\'pun_pm_show_new_count\'] = \'0\';

			if (!isset($form[\'pun_pm_show_global_link\']) || $form[\'pun_pm_show_global_link\'] != \'1\')
				$form[\'pun_pm_show_global_link\'] = \'0\';

			($hook = get_hook(\'pun_pm_aop_features_validation_end\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($form[\'pun_jquery_include_method\']))
			{
				$form[\'pun_jquery_include_method\'] = intval($form[\'pun_jquery_include_method\'], 10);
				if (($form[\'pun_jquery_include_method\'] < PUN_JQUERY_INCLUDE_METHOD_LOCAL) || ($form[\'pun_jquery_include_method\'] > PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN))
				{
					$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
				}
			}
			else
			{
				$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';


			if (!isset($form[\'pun_poll_enable_read\']) || $form[\'pun_poll_enable_read\'] != \'1\') $form[\'pun_poll_enable_read\'] = \'0\';
			if (!isset($form[\'pun_poll_enable_revote\']) || $form[\'pun_poll_enable_revote\'] != \'1\') $form[\'pun_poll_enable_revote\'] = \'0\';

			$form[\'pun_poll_max_answers\'] = intval($form[\'pun_poll_max_answers\']);

			if ($form[\'pun_poll_max_answers\'] > 100)
				$form[\'pun_poll_max_answers\'] = 100;

			if ($form[\'pun_poll_max_answers\'] < 2)
				$form[\'pun_poll_max_answers\'] = 2;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_stop_spam_max_links\'] = (!isset($form[\'fancy_stop_spam_max_links\']) ||  !is_numeric($form[\'fancy_stop_spam_max_links\'])) ? \'-1\' : intval($form[\'fancy_stop_spam_max_links\'], 10);
			$form[\'fancy_stop_spam_max_guest_links\'] = (!isset($form[\'fancy_stop_spam_max_guest_links\']) ||  !is_numeric($form[\'fancy_stop_spam_max_guest_links\'])) ? \'-1\' : intval($form[\'fancy_stop_spam_max_guest_links\'], 10);

			// Save settings
			if (!isset($form[\'fancy_stop_spam_register_form_honeypot\']) || $form[\'fancy_stop_spam_register_form_honeypot\'] != \'1\') $form[\'fancy_stop_spam_register_form_honeypot\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_timeout\']) || $form[\'fancy_stop_spam_register_form_timeout\'] != \'1\') $form[\'fancy_stop_spam_register_form_timeout\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_timezone\']) || $form[\'fancy_stop_spam_register_form_timezone\'] != \'1\') $form[\'fancy_stop_spam_register_form_timezone\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_sfs_email\']) || $form[\'fancy_stop_spam_register_form_sfs_email\'] != \'1\') $form[\'fancy_stop_spam_register_form_sfs_email\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_sfs_ip\']) || $form[\'fancy_stop_spam_register_form_sfs_ip\'] != \'1\') $form[\'fancy_stop_spam_register_form_sfs_ip\'] = \'0\';

			if (!isset($form[\'fancy_stop_spam_post_form_honeypot\']) || $form[\'fancy_stop_spam_post_form_honeypot\'] != \'1\') $form[\'fancy_stop_spam_post_form_honeypot\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_identical_posts\']) || $form[\'fancy_stop_spam_check_identical_posts\'] != \'1\') $form[\'fancy_stop_spam_check_identical_posts\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_signature\']) || $form[\'fancy_stop_spam_check_signature\'] != \'1\') $form[\'fancy_stop_spam_check_signature\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_submit\']) || $form[\'fancy_stop_spam_check_submit\'] != \'1\') $form[\'fancy_stop_spam_check_submit\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_use_logs\']) || $form[\'fancy_stop_spam_use_logs\'] != \'1\') $form[\'fancy_stop_spam_use_logs\'] = \'0\';

			$form[\'fancy_stop_spam_sfs_api_key\'] = substr(forum_trim($form[\'fancy_stop_spam_sfs_api_key\']), 0, 64);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_generate_navlinks_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link \'PM\' in the main nav menu
			if (isset($links[\'profile\']) && $forum_config[\'o_pun_pm_show_global_link\'])
			{
				global $lang_pun_pm;

				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				if (\'pun_pm\' == substr(FORUM_PAGE, 0, 6))
					$links[\'profile\'] = str_replace(\' class="isactive"\', \'\', $links[\'profile\']);

				($hook = get_hook(\'pun_pm_pre_main_navlinks_add\')) ? eval($hook) : null;

				$links[\'profile\'] .= "\\n\\t\\t".\'<li id="nav_pun_pm"\'.(\'pun_pm\' == substr(FORUM_PAGE, 0, 6) ? \' class="isactive"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm\']).\'"><span>\'.$lang_pun_pm[\'Private messages\'].\'</span></a></li>\';

				($hook = get_hook(\'pun_pm_after_main_navlinks_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_pun_forum_news;

			$tmp_links = array();
			foreach ($links as $link_index => $link_content)
			{
				$tmp_links[$link_index] = $link_content;
				if ($link_index == \'index\')
					$tmp_links[\'pun_forum_news\'] = \'<li id="forumnews"\'.((FORUM_PAGE == \'news\') ? \' class="isactive"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_forum_news\']).\'">\'.$lang_pun_forum_news[\'Forum news\'].\'</a></li>\';
			}
			$links = $tmp_links;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_post_contacts_merge' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_pun_pm;

			if (!isset($lang_pun_pm))
			{
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			}

			($hook = get_hook(\'pun_pm_pre_post_contacts_add\')) ? eval($hook) : null;

			// Links \'Send PM\' near posts
			if (!$forum_user[\'is_guest\'] && $cur_post[\'poster_id\'] > 1 && $forum_user[\'id\'] != $cur_post[\'poster_id\'])
				$forum_page[\'post_contacts\'][\'PM\'] = \'<a class="contact" title="\'.$lang_pun_pm[\'Send PM\'].\'" href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $cur_post[\'poster_id\']).\'">\'.$lang_pun_pm[\'PM\'].\'</a>\';

			($hook = get_hook(\'pun_pm_after_post_contacts_add\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_view_details_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link in the profile
			if (!$forum_user[\'is_guest\'] && $forum_user[\'id\'] != $user[\'id\'])
			{
				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				($hook = get_hook(\'pun_pm_pre_profile_user_contact_add\')) ? eval($hook) : null;

				$forum_page[\'user_contact\'][\'PM\'] = \'<li><span>\'.$lang_pun_pm[\'PM\'].\': <a href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $id).\'">\'.$lang_pun_pm[\'Send PM\'].\'</a></span></li>\';

				($hook = get_hook(\'pun_pm_after_profile_user_contact_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_avatars_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Admin options
if (!isset($lang_pun_pm))
{
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
}

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_pun_pm[\'Features title\'] ?></span></h2>
			</div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_pun_pm[\'PM settings\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_pm[\'Inbox limit\'] ?></span><small><?php echo $lang_pun_pm[\'Inbox limit info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[pun_pm_inbox_size]" size="6" maxlength="6" value="<?php echo $forum_config[\'o_pun_pm_inbox_size\'] ?>" /></span>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_pm[\'Outbox limit\'] ?></span><small><?php echo $lang_pun_pm[\'Outbox limit info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[pun_pm_outbox_size]" size="6" maxlength="6" value="<?php echo $forum_config[\'o_pun_pm_outbox_size\'] ?>" /></span>
					</div>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_pm[\'Navigation links\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_show_new_count]" value="1"<?php if ($forum_config[\'o_pun_pm_show_new_count\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Snow new count\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_show_global_link]" value="1"<?php if ($forum_config[\'o_pun_pm_show_global_link\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Show global link\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php ($hook = get_hook(\'pun_pm_aop_features_pre_pm_settings_fieldset_end\')) ? eval($hook) : null; ?>
			</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
				<div class="content-head">
					<h2 class="hn"><span><?php echo $lang_pun_poll[\'Name plugin\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group1">
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_revote]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_revote\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Disable revoting info\'] ?></span>
								<?php echo $lang_pun_poll[\'Disable revoting\'] ?>
							</label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_read]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_read\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Disable see results\'] ?></span>
								<?php echo $lang_pun_poll[\'Disable see results info\'] ?>
							</label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Maximum answers info\'] ?></span>
								<small><?php echo $lang_pun_poll[\'Maximum answers\'] ?></small>
							</label>
							</br>
							<span class="fld-input">
								<input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="form[pun_poll_max_answers]" size="6" maxlength="6" value="<?php echo $forum_config[\'p_pun_poll_max_answers\'] ?>"/>
							</span>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_settings_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Validate option \'quote beginning of message\'
			if (!isset($_POST[\'form\'][\'pun_pm_long_subject\']) || $_POST[\'form\'][\'pun_pm_long_subject\'] != \'1\')
				$form[\'pun_pm_long_subject\'] = \'0\';
			else
				$form[\'pun_pm_long_subject\'] = \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'pun_bbcode_enabled\'] = (!isset($_POST[\'form\'][\'pun_bbcode_enabled\']) || $_POST[\'form\'][\'pun_bbcode_enabled\'] != \'1\') ? \'0\' : \'1\';
			$form[\'pun_bbcode_use_buttons\'] = (!isset($_POST[\'form\'][\'pun_bbcode_use_buttons\']) || $_POST[\'form\'][\'pun_bbcode_use_buttons\'] != \'1\') ? \'0\' : \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_about_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link in the profile
			if (!$forum_user[\'is_guest\'] && $forum_user[\'id\'] != $user[\'id\'])
			{
				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				($hook = get_hook(\'pun_pm_pre_profile_user_contact_add\')) ? eval($hook) : null;

				$forum_page[\'user_contact\'][\'PM\'] = \'<li><span>\'.$lang_pun_pm[\'PM\'].\': <a href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $id).\'">\'.$lang_pun_pm[\'Send PM\'].\'</a></span></li>\';

				($hook = get_hook(\'pun_pm_after_profile_user_contact_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_settings_email_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Per-user option \'quote beginning of message\'
if ($forum_config[\'p_message_bbcode\'] == \'1\')
{
	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	$forum_page[\'item_count\'] = 0;

?>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><strong><?php echo $lang_pun_pm[\'PM settings\'] ?></strong></legend>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_pm[\'Private messages\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_long_subject]" value="1"<?php if ($user[\'pun_pm_long_subject\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Begin message quote\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php ($hook = get_hook(\'pun_pm_pf_change_details_settings_pre_pm_settings_fieldset_end\')) ? eval($hook) : null; ?>
			</fieldset>
<?php
}
else
	echo "\\t\\t\\t".\'<input type="hidden" name="form[pun_pm_long_subject]" value="\'.$user[\'pun_pm_long_subject\'].\'" />\'."\\n";

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include $ext_info[\'path\'].\'/lang/English/pun_bbcode.php\';

			$forum_page[\'item_count\'] = 0;
?>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_enabled]" value="1"<?php if ($user[\'pun_bbcode_enabled\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_bbcode[\'Pun BBCode Bar\'] ?></span> <?php echo $lang_pun_bbcode[\'Notice BBCode Bar\'] ?></label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_use_buttons]" value="1"<?php if ($user[\'pun_bbcode_use_buttons\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_bbcode[\'BBCode Graphical buttons\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'es_essentials' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].DIRECTORY_SEPARATOR.\'helper.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

define(\'PUN_JQUERY_INCLUDE_METHOD_LOCAL\', 0);
			define(\'PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN\', 1);
			define(\'PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN\', 2);
			define(\'PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN\', 3);

			define(\'PUN_JQUERY_VERSION\', \'1.7.1\');

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_new_section' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

App::$admin_section = true;
$forum_page[\'crumbs\'] = array(
	array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
	array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\']))
);		

App::route();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_message_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (App::$is_ajax)
{
	App::send_json(array(\'code\' => -1, \'message\' => $message, \'sender\' => \'developer_helper\'));
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_redirect_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (App::$is_ajax)
{
	App::send_json(array(\'code\' => -2, \'redirect\' => $message, \'destination_url\' => $destination_url, \'sender\' => \'developer_helper\'));
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_get_current_url_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_SERVER[\'HTTP_X_REQUESTED_WITH\']) AND $_SERVER[\'HTTP_X_REQUESTED_WITH\'] == \'XMLHttpRequest\' AND !isset($_POST[\'csrf_token\']))
{
	return $GLOBALS[\'forum_user\'][\'prev_url\'];
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_csrf_confirm_form_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_SERVER[\'HTTP_X_REQUESTED_WITH\']) AND $_SERVER[\'HTTP_X_REQUESTED_WITH\'] == \'XMLHttpRequest\' AND !defined(DEVELOPER_HELPER_CSRF_CONFIRM))
{		


//	foreach ($_POST as $submitted_key => $submitted_val)
//		if ($submitted_key != \'csrf_token\' && $submitted_key != \'prev_url\')
//		{
//			$hidden_fields = _csrf_confirm_form($submitted_key, $submitted_val);
//			foreach ($hidden_fields as $field_key => $field_val)
//				$forum_page[\'hidden_fields\'][$field_key] = \'<input type="hidden" name="\'.forum_htmlencode($field_key).\'" value="\'.forum_htmlencode($field_val).\'" />\';
//		}
		
	App::send_json(array(
		\'code\'		=>	-3, 
		\'message\'	=>	$lang_common[\'CSRF token mismatch\'],
		\'sender\'	=>	\'developer_helper\',
		\'csrf_token\'=>	generate_form_token(get_current_url()),	
		\'prev_url\'	=>	forum_htmlencode($forum_user[\'prev_url\']),
		
	));		
	return 1;
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_new_section' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

App::$profile_section = true;
$forum_page[\'crumbs\'] = array(
	array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
	array(sprintf($lang_profile[\'Users profile\'], $forum_user[\'username\']), forum_link($forum_url[\'user\'], $forum_user[\'id\']))
);
App::route();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'fancy_stop_spam_profile_section\') {
				if ($forum_user[\'g_id\'] != FORUM_ADMIN) {
					message($lang_common[\'Bad request\']);
				}

				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array(sprintf($lang_profile[\'Users profile\'], $user[\'username\']), forum_link($forum_url[\'user\'], $id)),
					$lang_fancy_stop_spam[\'Section antispam\'],
				);

				define(\'FORUM_PAGE\', \'profile-fancy_stop_spam_profile_section\');
				require FORUM_ROOT.\'header.php\';
				ob_start();
?>
				<div class="main-subhead">
					<h2 class="hn">
						<span><?php printf(($forum_user[\'id\'] == $id) ?
							$lang_fancy_stop_spam[\'Section antispam welcome\'] :
							$lang_fancy_stop_spam[\'Section antispam welcome user\'], forum_htmlencode($user[\'username\'])) ?>
						</span>
					</h2>
				</div>
				<div class="main-content main-frm">
					<div class="ct-group">
						<?php
							$fancy_stop_spam = Fancy_stop_spam::singleton();
							$fancy_stop_spam->print_user_status($user);
						?>
					</div>
					<?php
				        echo $fancy_stop_spam->print_logs($user[\'id\']);
					?>
				</div>
<?php
				$tpl_temp = forum_trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
				ob_end_clean();
				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_message_box' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_post_contents' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_message_box' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pun_pm_fn_send_form_pre_textarea_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_gzip_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_pun_jquery)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			// Reset counter
			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo sprintf($lang_pun_jquery[\'Setup jquery\'], PUN_JQUERY_VERSION) ?></span></h2>
			</div>

			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><strong><?php echo sprintf($lang_pun_jquery[\'Setup jquery legend\'], PUN_JQUERY_VERSION) ?></strong></legend>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_jquery[\'Include method\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_LOCAL; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_LOCAL) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method local label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method google label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method microsoft label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method jquery label\'] ?></label>
						</div>
					</div>
				</fieldset>
			</fieldset>

<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
		?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_stop_spam[\'Settings Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_stop_spam[\'Name\'] ?></span></legend>

					<!-- REGISTER FORM -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Register form\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_honeypot]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Honeypot\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_timeout]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_timeout\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Timeout\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_timezone]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_timezone\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Timezone\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_sfs_email]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_email\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable SFS Email\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_sfs_ip]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_ip\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable SFS IP\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- POST FORM -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Post form\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_post_form_honeypot]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Honeypot\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- OTHER METHOD -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Other Methods\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_identical_posts]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Check Identical\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_signature]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Signature Check Method\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_submit]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Submit Check Method\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_use_logs]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_use_logs\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Logs\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- FIRST POST METHOD -->
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'First Post Max Links\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'First Post Max Links Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_max_links]" size="3" maxlength="3" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_max_links\']) ?>" /></span>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'First Post Guest Max Links\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'First Post Guest Max Links Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_max_guest_links]" size="3" maxlength="3" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_max_guest_links\']) ?>" /></span>
						</div>
					</div>

					<!-- SFS API KEY -->
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'SFS API Key\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'SFS API Key Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_sfs_api_key]" size="35" maxlength="64" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_sfs_api_key\']) ?>" /></span>
						</div>
					</div>
				</fieldset>
		<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] !== \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			include $ext_info[\'path\'].\'/functions.php\';

			if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			else
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

			// No script CSS
			$forum_loader->add_css(\'#pun_poll_switcher_block, #pun_poll_add_options_link { display: none; } #pun_poll_form_block, #pun_poll_update_block { display: block !important; }\', array(\'type\' => \'inline\', \'noscript\' => true));

			// JS
			$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] !== \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			include $ext_info[\'path\'].\'/functions.php\';

			if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			else
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

			// No script CSS
			$forum_loader->add_css(\'#pun_poll_switcher_block, #pun_poll_add_options_link { display: none; } #pun_poll_form_block, #pun_poll_update_block { display: block !important; }\', array(\'type\' => \'inline\', \'noscript\' => true));

			// JS
			$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']) && $poll_question !== FALSE && empty($errors))
			{
				Pun_poll::add_poll($new_tid, $poll_question, $poll_answers, $poll_days !== FALSE ? $poll_days : \'NULL\', $poll_votes !== FALSE ? $poll_votes : \'NULL\', $poll_read_unvote_users === FALSE  ? \'0\' : $poll_read_unvote_users, $poll_revote === FALSE ? \'0\' : $poll_revote);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_post_selected' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$topic_poll = FALSE;
			if ($can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\'])) {
				$pun_poll_query = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
				);
				$pun_poll_results = $forum_db->query_build($pun_poll_query) or error(__FILE__, __LINE__);

				if ($row = $forum_db->fetch_row($pun_poll_results)) {
					list($poll_question, $poll_read_unvote_users, $poll_revote, $poll_created, $poll_days_count, $poll_votes_count) = $row;
					$topic_poll = TRUE;
				}

				if ($topic_poll) {
					$pun_poll_query = array(
						\'SELECT\'	=>	\'answer\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'],
						\'ORDER BY\'	=>	\'id ASC\'
					);
					$pun_poll_results = $forum_db->query_build($pun_poll_query) or error(__FILE__, __LINE__);

					$poll_answers = array();
					while ($cur_answer = $forum_db->fetch_assoc($pun_poll_results)) {
						$poll_answers[] = $cur_answer[\'answer\'];
					}

					if (empty($poll_answers)) {
						message($lang_common[\'Bad request\']);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($_POST[\'reset_poll\']) || $_POST[\'reset_poll\'] != \'1\') {

				if (($forum_user[\'group_id\'] == FORUM_ADMIN && $can_edit_subject) || ($can_edit_subject && !$topic_poll)) {
					// Get information about new poll.
					$new_poll_question = isset($_POST[\'question_of_poll\']) && !empty($_POST[\'question_of_poll\']) ? $_POST[\'question_of_poll\'] : FALSE;
					if (!empty($new_poll_question)) {
						$new_poll_answers = isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) ? $_POST[\'poll_answer\'] : FALSE;
						$new_poll_days = isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\']) ? $_POST[\'allow_poll_days\'] : FALSE;
						$new_poll_votes = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? $_POST[\'allow_poll_votes\'] : FALSE;
						$new_read_unvote_users = isset($_POST[\'read_unvote_users\']) && !empty($_POST[\'read_unvote_users\']) ? $_POST[\'read_unvote_users\'] : FALSE;
						$new_revote = isset($_POST[\'revouting\']) ? $_POST[\'revouting\'] : FALSE;

						Pun_poll::data_validation($new_poll_question, $new_poll_answers, $new_poll_days, $new_poll_votes, $new_read_unvote_users, $new_revote);
					}

					if (isset($_POST[\'update_poll\'])) {
						$new_poll_ans_count = isset($_POST[\'poll_ans_count\']) && intval($_POST[\'poll_ans_count\']) > 0 ? intval($_POST[\'poll_ans_count\']) : FALSE;

						if (!$new_poll_ans_count)
							$errors[] = $lang_pun_poll[\'Empty option count\'];
						if ($new_poll_ans_count < 2)
						{
							$errors[] = $lang_pun_poll[\'Min cnt options\'];
							$new_poll_ans_count = 2;
						}

						if ($new_poll_ans_count > $forum_config[\'p_pun_poll_max_answers\'])
						{
							$errors[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
							$new_poll_ans_count = $forum_config[\'p_pun_poll_max_answers\'];
						}

						$_POST[\'preview\'] = 1;
					} else if ($new_poll_question !== FALSE && empty($errors) && !isset($_POST[\'preview\'])) {
						if (!$topic_poll) {
							Pun_poll::add_poll($cur_post[\'tid\'], $new_poll_question, $new_poll_answers, $new_poll_days !== FALSE ? $new_poll_days : \'NULL\', $new_poll_votes !== FALSE ? $new_poll_votes : \'NULL\', $new_read_unvote_users !== FALSE ? $new_read_unvote_users : \'0\', $new_revote !== FALSE ? $new_revote : \'0\');
						} else {
							Pun_poll::update_poll($cur_post[\'tid\'], $new_poll_question, $new_poll_answers, $new_poll_days !== FALSE ? $new_poll_days : null, $new_poll_votes !== FALSE ? $new_poll_votes : null, $new_read_unvote_users !== FALSE ? $new_read_unvote_users : \'0\', $new_revote !== FALSE ? $new_revote : \'0\', $poll_question, $poll_answers, $poll_days_count, $poll_votes_count, $poll_read_unvote_users, $poll_revote);
						}
					}

				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$pun_forum_news = isset($_POST[\'pun_forum_news\']) ? 1 : 0;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_stop_spam = Fancy_stop_spam::singleton();
			$check_max_links_result = $fancy_stop_spam->max_links_check($message);

			if ($check_max_links_result !== TRUE) {
				$errors[] = $check_max_links_result;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($_POST[\'preview\']) && $can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\'])) {
				$reset_poll = (isset($_POST[\'reset_poll\']) && $_POST[\'reset_poll\'] == \'1\') ? true : false;
				$remove_poll = (isset($_POST[\'remove_poll\']) && $_POST[\'remove_poll\'] == \'1\') ? true : false;

				// We need to reset poll
				if ($reset_poll) {
					Pun_poll::reset_poll($cur_post[\'tid\']);
				}

				if ($remove_poll) {
					Pun_poll::remove_poll($cur_post[\'tid\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && isset($_POST[\'update_poll\']) && empty($errors))	{
				$new_poll_ans_count = isset($_POST[\'poll_ans_count\']) && intval($_POST[\'poll_ans_count\']) > 0 ? intval($_POST[\'poll_ans_count\']) : FALSE;

				if (!$new_poll_ans_count)
					$errors[] = $lang_pun_poll[\'Empty option count\'];

				if ($new_poll_ans_count < 2)
				{
					$errors[] = $lang_pun_poll[\'Min cnt options\'];
					$new_poll_ans_count = 2;
				}

				if ($new_poll_ans_count > $forum_config[\'p_pun_poll_max_answers\'])
				{
					$errors[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
					$new_poll_ans_count = $forum_config[\'p_pun_poll_max_answers\'];
				}

				$_POST[\'preview\'] = \'pun_poll\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$pun_forum_news = isset($_POST[\'pun_forum_news\']) ? 1 : 0;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] &&
					(utf8_strlen($message) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH) &&
					($forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK)) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					if ($fancy_stop_spam->identical_message_check($forum_user[\'id\'], sha1($message))) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_IDENTICAL_POST, $forum_user[\'id\'], get_remote_address());
						$errors[] = $lang_fancy_stop_spam[\'Post Identical message\'];
					}
				}
			}

			$fancy_stop_spam = Fancy_stop_spam::singleton();
			$check_max_links_result = $fancy_stop_spam->max_links_check($message);

			if ($check_max_links_result !== TRUE) {
				$errors[] = $check_max_links_result;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				$poll_question = isset($_POST[\'question_of_poll\']) && !empty($_POST[\'question_of_poll\']) ? $_POST[\'question_of_poll\'] : FALSE;
				if (!empty($poll_question))
				{
					$poll_answers = isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) ? $_POST[\'poll_answer\'] : FALSE;
					$poll_days = isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\']) ? $_POST[\'allow_poll_days\'] : FALSE;
					$poll_votes = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? $_POST[\'allow_poll_votes\'] : FALSE;
					$poll_read_unvote_users = isset($_POST[\'read_unvote_users\']) && !empty($_POST[\'read_unvote_users\']) ? $_POST[\'read_unvote_users\'] : FALSE;
					$poll_revote = isset($_POST[\'revouting\']) && !empty($_POST[\'revouting\']) ? $_POST[\'revouting\'] : FALSE;

					Pun_poll::data_validation($poll_question, $poll_answers, $poll_days, $poll_votes, $poll_read_unvote_users, $poll_revote);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\' && !isset($_POST[\'preview\'])) {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam = Fancy_stop_spam::singleton();
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						$errors[] = $lang_fancy_stop_spam[\'Post bot message\'];
					}
				}
			}

			// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\' && !isset($_POST[\'preview\']) && $forum_user[\'is_guest\']) {
				if (($_POST[\'submit\'] != $lang_post[\'Submit reply\'].Fancy_stop_spam::SUBMIT_MARK) ||
					($_POST[\'submit\'] != $lang_post[\'Submit topic\'].Fancy_stop_spam::SUBMIT_MARK)) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//
			$forum_page[\'hidden_fields\'][\'pun_poll_block_status\'] = \'<input type="hidden" name="pun_poll_block_open" id="pun_poll_block_status" value="1" />\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && isset($_POST[\'update_poll\']) && isset($_POST[\'preview\']) && $_POST[\'preview\'] == \'pun_poll\') {
				unset($_POST[\'preview\']);
			}

			//
			$forum_page[\'hidden_fields\'][\'pun_poll_block_status\'] = \'<input type="hidden" name="pun_poll_block_open" id="pun_poll_block_status" value="0" />\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
				$forum_page[\'hidden_fields\'][\'form_honey_key_id\'] = \'<input type="hidden" name="form_honey_key_id" value="\'.$fancy_stop_spam_post_key_id.\'" />\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Is there something to show?
			if (isset($pun_poll[\'read_unvote_users\']) && !$forum_user[\'is_guest\']) {
				// If we don\'t get count of votes
				if (!isset($vote_count)) {
					$query_pun_poll = array(
						\'SELECT\'	=>	\'COUNT(*) AS vote_count\',
						\'FROM\'		=>	\'voting\',
						\'WHERE\'		=>	\'topic_id=\'.$id
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					$row = $forum_db->fetch_assoc($result_pun_poll);
					$vote_count = $row[\'vote_count\'];
				}

				// Showing of vote-form if users can revote or user don\'t vote
				if (!$end_voting && (($is_voted_user && $pun_poll[\'revote\']) || $is_voted_user === false)) {
					$query_pun_poll = array(
						\'SELECT\'	=>	\'id, answer\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id=\'.$id,
						\'ORDER BY\'	=>	\'id ASC\'
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

					$pun_poll_answers = array();
					while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
						$pun_poll_answers[] = $row;
					}

					if (!empty($pun_poll_answers))
					{
						$vote_form = \'\';
						$link = forum_link($forum_url[\'topic\'], $id);

						$vote_form = \'
							<div class="pun_poll_item unvotted">
								<div class="pun_poll_header">\'.forum_htmlencode($pun_poll[\'question\']).\'</div>
								<div class="main-frm">
									<form class="frm-form" action="\'.$link.\'" accept-charset="utf-8" method="post">
										<fieldset class="frm-group group1">
											<div class="hidden">
												<input type="hidden" name="csrf_token" value="\'.generate_form_token($link).\'" />
											</div>
											<fieldset class="mf-set set1">
												<legend><span>\'.$lang_pun_poll[\'Options\'].\'</span></legend>
												<div class="mf-box">\';

						// Determine old answer of user
						if (!isset($old_answer_id)) {
							$query_pun_poll = array(
								\'SELECT\'	=>	\'answer_id\',
								\'FROM\'		=>	\'voting\',
								\'WHERE\'		=>	\'topic_id = \'.$id.\' AND user_id = \'.$forum_user[\'id\'],
								\'ORDER BY\'	=>	\'answer_id ASC\'
							);
							$result_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

							// If there is something?
							$row = $forum_db->fetch_assoc($result_poll);
							if ($row) {
								$old_answer_id = $row[\'answer_id\'];
							}
							unset($result_poll);
						}


						$num = 0;
						foreach ($pun_poll_answers as $answer) {
							$num++;
							$vote_form .= \'
								<div class="mf-item pun_poll_answer_block" data-num="\'.$num.\'">
									<span class="fld-input">
										<input id="fld\'.$num.\'" type="radio"\'.((isset($old_answer_id) && $old_answer_id == $answer[\'id\']) ? \' checked="checked"\' : \'\').\' value="\'.$answer[\'id\'].\'" name="answer" />
									</span>
									<label for="fld\'.$num.\'">\'.forum_htmlencode($answer[\'answer\']).\'</label>
								</div>\';
						}

						$vote_form .= \'
												</div>
											</fieldset>
										</fieldset>
										<div class="frm-buttons">
											<span class="submit">
												<input type="submit" value="\'.$lang_pun_poll[\'But note\'].\'" name="vote" />
											</span>
										</div>
									</form>
								</div>
							</div>\';
					}
				}

				// Showing voting results if user have voted or unread user can see voting results
				if ($end_voting || $is_voted_user || (!$is_voted_user && $pun_poll[\'read_unvote_users\'])) {
					if (isset($vote_count) && $vote_count > 0) {
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer, COUNT(v.id) as num_vote\',
							\'FROM\'		=>	\'answers as a\',
							\'JOINS\'		=>	array(
								array(
									\'LEFT JOIN\'	=>	\'voting AS v\',
									\'ON\'		=>	\'a.id=v.answer_id\'
								)
							),
							\'WHERE\'		=>	\'a.topic_id=\'.$id,
							\'GROUP BY\'	=>	\'a.id\',
							\'ORDER BY\'	=>	\'a.id\'
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

						$vote_results = \'<div class="pun_poll_item votted"><div class="pun_poll_header">\'.forum_htmlencode($pun_poll[\'question\']).\'</div>\';
						$vote_results_raw = array();
						$num = $winner_index = $cur_vote_index = 0;
						$max_vote = $num_winner = 0;

						while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
							$vote_results_raw[] = $row;
							if ($row[\'num_vote\'] > $max_vote) {
								$max_vote = $row[\'num_vote\'];
								$winner_index = $cur_vote_index;
							}

							$cur_vote_index++;
						}

						// Case when winner is not one
						foreach ($vote_results_raw as $vote) {
							if ($vote[\'num_vote\'] == $max_vote) {
								$num_winner++;
							}
						}

						if ($num_winner !== 1) {
							// No winner
							$winner_index = -1;
						}

						foreach ($vote_results_raw as $vote) {
							$pollResultWidth = ((float)/**/$vote[\'num_vote\'] / $vote_count * 100);
							$vote_results .= \'
								<dl>
									<dt><strong>\'.forum_number_format((float)/**/$vote[\'num_vote\'] / $vote_count * 100).\'%</strong><br/>(\'.$vote[\'num_vote\'].\')</dt>
									<dd>\'.forum_htmlencode($vote[\'answer\'])
										.\'<div class="\'.(($winner_index == $num) ? \'winner\' : \'\').(($pollResultWidth > 0) ? \'\' : \' poll-empty\').\'" style="width: \'.$pollResultWidth.\'%;"></div>
									</dd>
								</dl>\';
							$num++;
						}

						$num++;
						$vote_results .= \'<p class="pun_poll_total">\'.$lang_pun_poll[\'Users count\'].$vote_count.\'</p>\';
						$vote_results .= \'</div>\';
					} else {
						$vote_results = \'<div class="ct-box info-box"><p>\'.$lang_pun_poll[\'No votes\'].\'</p></div>\';
					}
				} else {
					$vote_results = \' \';
				}

				unset($tmp_pagepost, $vote_count, $num, $result_pun_poll, $query_pun_poll, $count_v, $answer, $is_voted_user, $end_voting, $pun_poll);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_main_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				//Is there something?
				if ($topic_poll) {
					if ($forum_user[\'group_id\'] == FORUM_ADMIN) {
						Pun_poll::show_form(isset($new_poll_question) ? $new_poll_question : $poll_question, isset($new_poll_answers) ? $new_poll_answers : $poll_answers, isset($new_poll_ans_count) ? $new_poll_ans_count : (isset($new_poll_answers) ? count($new_poll_answers) : count($poll_answers)), isset($new_poll_days) ? $new_poll_days : $poll_days_count, isset($new_poll_votes) ? $new_poll_votes : $poll_votes_count, isset($new_read_unvote_users) ? $new_read_unvote_users : $poll_read_unvote_users, isset($new_revote) ? $new_revote : $poll_revote, true);
					}
				} else {
					Pun_poll::show_form(isset($new_poll_question) ? $new_poll_question : \'\', isset($new_poll_answers) ? $new_poll_answers : \'\', isset($new_poll_ans_count) ? $new_poll_ans_count : (isset($new_poll_answers) ? (count($new_poll_answers) > 2 ? count($new_poll_answers) : 2) : 2), isset($new_poll_days) ? $new_poll_days : FALSE, isset($new_poll_votes) ? $new_poll_votes : FALSE, $forum_config[\'p_pun_poll_enable_read\'] ? (isset($new_read_unvote_users) ? $new_read_unvote_users : \'0\') : FALSE, $forum_config[\'p_pun_poll_enable_revote\'] ? (isset($new_revote) ? $new_revote : \'0\') : FALSE);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_qr_get_forum_data' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_POST[\'merge_topics\']) || isset($_POST[\'merge_topics_comply\']))
			{
				$poll_topics = isset($_POST[\'topics\']) && !empty($_POST[\'topics\']) ? $_POST[\'topics\'] : array();
				$poll_topics = array_map(\'intval\', (is_array($poll_topics) ? $poll_topics : explode(\',\', $poll_topics)));

				if (empty($poll_topics))
					message($lang_misc[\'No topics selected\']);

				if (count($poll_topics) == 1)
					message($lang_misc[\'Merge error\']);

				$query_poll = array(
					\'SELECT\'	=>	\'topic_id\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $poll_topics).\')\'
				);
				$result_pun_poll = $forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

				$polls = array();
				while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
					$polls[] = $row[\'topic_id\'];
				}

				if (count($polls) > 1) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

					message($lang_pun_poll[\'Merge error\']);
				} else if (count($polls) === 1) {
					$question_id = $polls[0];
				}

				unset($num_polls, $polls);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_modify_topic_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_user[\'is_guest\']) {
				//Get info about poll
				$query_pun_poll = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count AS max_votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$id
				);
				$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
				$pun_poll = $forum_db->fetch_assoc($result_pun_poll);

				// Is there something?
				if (!is_null($pun_poll) && $pun_poll !== false) {
					if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
						$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
					else
						$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

					// JS
					$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

					$end_voting = false;
					$pun_poll[\'revote\'] = ($forum_config[\'p_pun_poll_enable_revote\'] == \'1\') ? $pun_poll[\'revote\'] : 0;
					$pun_poll[\'read_unvote_users\'] = ($forum_config[\'p_pun_poll_enable_read\'] == \'1\') ? $pun_poll[\'read_unvote_users\'] : 0;

					// Check up for condition of end poll
					if ($pun_poll[\'days_count\'] != 0 && time() > $pun_poll[\'created\'] + $pun_poll[\'days_count\'] * 86400) {
						$end_voting = true;
					} else if ($pun_poll[\'max_votes_count\'] != 0) {
						// Get count of votes
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(id) AS vote_count\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id=\'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$row = $forum_db->fetch_assoc($result_pun_poll);
						$vote_count = $row[\'vote_count\'];

						if ($vote_count >= $pun_poll[\'max_votes_count\']) {
							$end_voting = true;
						}
					}

					if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

					// Does user want to vote?
					if (isset($_POST[\'vote\'])) {
						if ($end_voting) {
							message($lang_pun_poll[\'End of vote\']);
						}

						$answer_id = isset($_POST[\'answer\']) ? intval($_POST[\'answer\']) : 0;
						if ($answer_id < 1) {
							message($lang_common[\'Bad request\']);
						}

						// Is there answer with this id?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(*)\',
							\'FROM\'		=>	\'answers\',
							\'WHERE\'		=>	\'topic_id=\'.$id.\' AND id=\'.$answer_id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						if ($forum_db->result($result_pun_poll) < 1) {
							message($lang_common[\'Bad request\']);
						}

						// Have user voted?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer_id\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id=\'.$id.\' AND user_id=\'.$forum_user[\'id\']
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$row = $forum_db->fetch_assoc($result_pun_poll);
						$old_answer_id = FALSE;
						if ($row) {
							$old_answer_id = $row[\'answer_id\'];
						}

						// CAN revote?
						if (!$pun_poll[\'revote\'] && $old_answer_id !== FALSE) {
							message($lang_pun_poll[\'User vote error\']);
						}

						// If user have voted we update table,
						// if not - insert new record
						if ($pun_poll[\'revote\'] && $old_answer_id !== FALSE) {
							// Do we needed to update DB?
							if ($old_answer_id != $answer_id) {
								$query_pun_poll = array(
									\'UPDATE\'	=>	\'voting\',
									\'SET\'		=>	\'answer_id=\'.$answer_id,
									\'WHERE\'		=>	\'topic_id=\'.$id.\' AND user_id=\'.$forum_user[\'id\']
								);
								$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

								// Replace old answer id with new for correct output
								$old_answer_id = $answer_id;
							}
						} else {
							// Add new record
							$query_pun_poll = array(
								\'INSERT\'	=>	\'topic_id, user_id, answer_id\',
								\'INTO\'		=>	\'voting\',
								\'VALUES\'	=>	$id.\', \'.$forum_user[\'id\'].\', \'.$answer_id
							);
							$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						}

						redirect(forum_link($forum_url[\'topic\'], array($id, sef_friendly($cur_topic[\'subject\']))), $lang_pun_poll[\'Poll redirect\']);
					} else {
						// Determine user have voted or not
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(*)\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'user_id=\'.$forum_user[\'id\'].\' AND topic_id=\'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$is_voted_user = ($forum_db->result($result_pun_poll) > 0) ? true : false;
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_preview_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ((($forum_user[\'group_id\'] == FORUM_ADMIN && $can_edit_subject) || ($can_edit_subject && !$topic_poll)) && empty($errors)) {
				if (!empty($new_poll_question) && !empty($new_poll_answers)) {
					$forum_page[\'preview_message\'] .= Pun_poll::poll_preview($new_poll_question, $new_poll_answers);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_preview_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']) && $poll_question !== FALSE && empty($errors)) {
				$forum_page[\'preview_message\'] .= Pun_poll::poll_preview($poll_question, $poll_answers);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_req_info_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				$_poll_question = isset($poll_question) ? $poll_question : \'\';
				$_poll_answers = isset($poll_answers) ? $poll_answers : array();
				$_poll_answers_num = isset($new_poll_ans_count) ? $new_poll_ans_count : ((isset($poll_answers) && count($poll_answers) > 1) ? count($poll_answers) : 2);

				Pun_poll::show_form($_poll_question, $_poll_answers, $_poll_answers_num, !empty($poll_days) ? $poll_days : \'\', !empty($poll_votes) ? $poll_votes : \'\', isset($poll_read_unvote_users) ? $poll_read_unvote_users : \'0\', isset($poll_revote) ? $poll_revote : \'0\');
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_post[\'Submit reply\'] .= Fancy_stop_spam::SUBMIT_MARK;
			$lang_post[\'Submit topic\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_prune_qr_prune_topics' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_edit_end_qr_update_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SET\'] .= \', g_poll_add=\'.((isset($_POST[\'poll_add\']) && $_POST[\'poll_add\'] == \'1\') ? 1 : 0);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
				$query[\'SET\'] .= \', link_color = \\\'\'.$forum_db->escape($link_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', link_color = NULL\';
			if (!empty($hover_color))
				$query[\'SET\'] .= \', hover_color = \\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', hover_color = NULL\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SET\'] .= \', g_add_forum_news = \'.$pun_forum_news_add_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_delete_topic_qr_delete_topic' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include_once $ext_info[\'path\'].\'/functions.php\';

			Pun_poll::remove_poll($topic_id);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_merge_topics_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($question_id) && $question_id != $merge_to_tid)
			{
				$query_poll = array(
					\'UPDATE\'	=>	\'questions\',
					\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
					\'WHERE\'		=>	\'topic_id = \'.$question_id
				);
				$forum_db->query_build($query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_delete_topics_qr_delete_topics' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_group_user_permissions_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			?>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend>
						<span><?php echo $lang_pun_poll[\'Permission\'] ?></span>
					</legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input">
								<input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="poll_add" value="1"<?php if ($group[\'g_poll_add\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_poll[\'Poll add\'] ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
			<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
				<legend><span><?php echo $lang_pun_forum_news[\'Permission legend\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="add_forum_news" value="1" <?php if ($group[\'g_add_forum_news\'] == 1) echo \' checked="checked"\' ?>  /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_forum_news[\'Permission text\'] ?></label>
						</div>
					</div>
			</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_end_qr_add_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
			{
				$query[\'INSERT\'] .= \', link_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($link_color).\'\\\'\';
			}

			if (!empty($hover_color))
			{
				$query[\'INSERT\'] .= \', hover_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'INSERT\'] .= \', g_add_forum_news\';
			$query[\'VALUES\'] .= \', \'.$pun_forum_news_add_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$link_color = forum_trim($_POST[\'link_color\']);
			$hover_color = forum_trim($_POST[\'hover_color\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_forum_news_add_news = isset($_POST[\'add_forum_news\']) ? intval($_POST[\'add_forum_news\']) : \'0\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_users_online_qr_get_online_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', u.group_id\';
			$query[\'JOINS\'][] = array(
				\'LEFT JOIN\'	=> \'users AS u\',
				\'ON\'		=> \'u.id=o.user_id\'
			);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_users_online_pre_online_info_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$users = array();
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			while ($forum_user_online = $forum_db->fetch_assoc($result))
			{
				if ($forum_user_online[\'user_id\'] > 1)
				{
					$users[] = ($forum_user[\'g_view_users\'] == \'1\') ? \'<span class="group_color_\'.$forum_user_online[\'group_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $forum_user_online[\'user_id\']).\'">\'.forum_htmlencode($forum_user_online[\'ident\']).\'</a></span>\' : forum_htmlencode($forum_user_online[\'ident\']);
				};
			};

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_group_pre_basic_details_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\';
			else
					include $ext_info[\'path\'].\'/lang/English/pun_colored_usergroups.php\';
			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'link\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="link_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'link_color\']) ?>" /></span>
					</div>
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'hover\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="hover_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'hover_color\']) ?>" /></span>
					</div>
				</div>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/hook_dispatcher.php\';
            Thanks_Hook_Dispatcher::profile_init();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ul_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/hook_dispatcher.php\';
            Thanks_Hook_Dispatcher::front_end_init();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/hook_dispatcher.php\';
            Thanks_Hook_Dispatcher::back_end_init();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
				require $ext_info[\'path\'].\'/main.php\';
			}
			cache_pun_coloured_usergroups();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_post_ident_merge' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($cur_post[\'poster_id\'] > 1)
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), (($forum_user[\'g_view_users\'] == \'1\') ? \'<em class="group_color_\'.$cur_post[\'g_id\'].\'"><a title="\'.sprintf($lang_topic[\'Go to profile\'], forum_htmlencode($cur_post[\'username\'])).\'" href="\'.forum_link($forum_url[\'user\'], $cur_post[\'poster_id\']).\'">\'.forum_htmlencode($cur_post[\'username\']).\'</a></em>\' : \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\')).\'</span>\';
			else
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\').\'</span>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ul_results_row_pre_data_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'table_row\'][\'username\'] = \'<td class="tc\'.count($forum_page[\'table_row\']).\'"><span class="group_color_\'.$user_data[\'g_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $user_data[\'id\']).\'">\'.forum_htmlencode($user_data[\'username\']).\'</a></span></td>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_about_output_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'user_ident\'][\'username\'] = \'<li class="username\'.(($user[\'realname\'] ==\'\') ? \' fn nickname\' :  \' nickname\').\'"><strong class="group_color_\'.$user[\'g_id\'].\'">\'.forum_htmlencode($user[\'username\']).\'</strong></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'nya_thanks\',
\'path\'			=> FORUM_ROOT.\'extensions/nya_thanks\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/nya_thanks\',
\'dependencies\'	=> array (
\'developer_helper\'	=> array(
\'id\'				=> \'developer_helper\',
\'path\'			=> FORUM_ROOT.\'extensions/developer_helper\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/developer_helper\'),
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/hook_dispatcher.php\';
            Thanks_Hook_Dispatcher::back_end_init();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'co_common' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/fancy_stop_spam.inc.php\';

			// Load LANG
			if (!isset($lang_fancy_stop_spam)) {
				if ($forum_user[\'language\'] != \'English\' &&
				file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ex_new_action' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'news\')
			{
				// Determine what type of feed to output
				$type = isset($_GET[\'type\']) && in_array($_GET[\'type\'], array(\'html\', \'rss\', \'atom\', \'xml\')) ? $_GET[\'type\'] : \'html\';

				$show = isset($_GET[\'show\']) ? intval($_GET[\'show\']) : 15;
				if ($show < 1 || $show > 50)
					$show = 15;

				$pun_forum_news_query = array(
					\'SELECT\'	=>	\'post_id\',
					\'FROM\'		=>	\'pun_forum_news AS news\',
					\'JOINS\'		=>	array(
						array(
							\'LEFT JOIN\'	=> \'forum_perms AS fp\',
							\'ON\'		=> \'(fp.forum_id = news.forum_id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=>	\'(fp.read_forum IS NULL OR fp.read_forum = 1)\',
					\'ORDER BY\'	=>	\'news.posted DESC\'
				);
				$pun_forum_news_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

				$no_news = FALSE;
				$post_news_id = array();
				while ($cur_news = $forum_db->fetch_assoc($pun_forum_news_result))
					$post_news_id[] = $cur_news[\'post_id\'];

				if (count($post_news_id) > 0)
				{
					$post_news_id = array_slice($post_news_id, 0, $show);
					$pun_forum_news_query = array(
						\'SELECT\'	=>	\'news.*, t.subject\',
						\'FROM\'		=>	\'pun_forum_news AS news\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'posts AS p\',
								\'ON\'			=> \'news.post_id = p.id\'
							),
							array(
								\'INNER JOIN\'	=> \'topics AS t\',
								\'ON\'			=> \'p.topic_id = t.id\'
							)
						),
						\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $post_news_id).\')\'
					);
					$query_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

					$posts_info = array();
					while ($cur_post = $forum_db->fetch_assoc($query_result))
					{
						$tmp_index = array_search($cur_post[\'post_id\'], $post_news_id);
						$posts_info[$tmp_index] = $cur_post;
					}
					ksort($posts_info);
					unset($post_news_id);

					if (!defined(\'FORUM_PARSER_LOADED\'))
						require FORUM_ROOT.\'include/parser.php\';

					// Setup the feed
					$feed = array(
						\'title\' 		=>	$forum_config[\'o_board_title\'].$lang_common[\'Title separator\'].$lang_pun_forum_news[\'Forum news\'],
						\'link\'			=>	forum_link($forum_url[\'pun_forum_news\']),
						\'description\'	=>	$lang_pun_forum_news[\'Forum news\'],
						\'items\'			=>	array(),
						\'type\'			=>	\'news\'
					);
					foreach ($posts_info as $post_num => $post_info)
					{
						if ($forum_config[\'o_censoring\'] == \'1\')
							$post_info[\'message\'] = censor_words($post_info[\'message\']);

						$post_info[\'message\'] = parse_message($post_info[\'message\'], $post_info[\'hide_smilies\']);

						$item = array(
							\'id\'			=>	$post_info[\'post_id\'],
							\'title\'			=>	$lang_common[\'RSS reply\'].$post_info[\'subject\'],
							\'link\'			=>	forum_link($forum_url[\'post\'], $post_info[\'post_id\']),
							\'description\'	=>	$post_info[\'message\'],
							\'author\'		=>	array(
								\'name\'	=> $post_info[\'poster\'],
							),
							\'pubdate\'		=>	$post_info[\'posted\']
						);

						$feed[\'items\'][] = $item;
					}

					$output_func = \'output_\'.$type;
					$output_func($feed);
				}
				else
					exit($lang_common[\'Bad request\']);

				exit;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				if ($cur_post[\'forum_news\'])
				{
					if ($pun_forum_news)
					{
						$pun_forum_news_query = array(
							\'UPDATE\'	=>	\'pun_forum_news\',
							\'SET\'		=>	\'message=\\\'\'.$forum_db->escape($message).\'\\\', hide_smilies=\\\'\'.$hide_smilies.\'\\\'\',
							\'WHERE\'		=>	\'post_id = \'.$id
						);
					}
					else
					{
						$pun_forum_news_query = array(
							\'DELETE\'	=>	\'pun_forum_news\',
							\'WHERE\'		=>	\'post_id = \'.$id
						);
					}
					$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
				}
				else
				{
					if ($pun_forum_news)
					{
						$pun_forum_news_query = array(
							\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
							\'INTO\'		=>	\'pun_forum_news\',
							\'VALUES\'	=>	$id.\', \\\'\'.$forum_db->escape($cur_post[\'poster\']).\'\\\', \'.$cur_post[\'poster_id\'].\', \\\'\'.$forum_db->escape($message).\'\\\', \'.$hide_smilies.\', \'.$cur_post[\'posted\'].\', \'.$cur_post[\'fid\']
						);
						$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_post_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $post_info[\'forum_news\'])
			{
				$pun_forum_news_query = array(
					\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
					\'INTO\'		=>	\'pun_forum_news\',
					\'VALUES\'	=>	$new_pid.\', \\\'\'.$forum_db->escape($post_info[\'poster\']).\'\\\', \'.$post_info[\'poster_id\'].\', \\\'\'.$forum_db->escape($post_info[\'message\']).\'\\\', \'.$post_info[\'hide_smilies\'].\', \'.$post_info[\'posted\'].\', \'.$post_info[\'forum_id\']
				);
				$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;

			if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] && utf8_strlen($post_info[\'message\']) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH &&
					$forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->identical_message_add($post_info[\'poster_id\'], $new_pid, sha1($post_info[\'message\']), $post_info[\'posted\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_add_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$post_info[\'forum_news\'] = $pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_topic_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $post_info[\'forum_news\'])
			{
				$pun_forum_news_query = array(
					\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
					\'INTO\'		=>	\'pun_forum_news\',
					\'VALUES\'	=>	$new_pid.\', \\\'\'.$forum_db->escape($post_info[\'poster\']).\'\\\', \'.$post_info[\'poster_id\'].\', \\\'\'.$forum_db->escape($post_info[\'message\']).\'\\\', \'.$post_info[\'hide_smilies\'].\', \'.$post_info[\'posted\'].\', \'.$post_info[\'forum_id\']
				);
				$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;

			if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] && utf8_strlen($post_info[\'message\']) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH &&
					$forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->identical_message_add($post_info[\'poster_id\'], $new_pid, sha1($post_info[\'message\']), $post_info[\'posted\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_add_topic' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$post_info[\'forum_news\'] = $pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_qr_update_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $pun_forum_news != $cur_post[\'forum_news\'])
				$query[\'SET\'] .= \', forum_news = \'.$pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_qr_get_post_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$query[\'SELECT\'] .= \', p.forum_news\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_checkbox_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				if (isset($_POST[\'form_sent\']))
					$pun_forum_news_option = isset($_POST[\'pun_forum_news\']) ? 1 : 0;
				else
					$pun_forum_news_option = $cur_post[\'forum_news\'];
				$forum_page[\'checkboxes\'][\'pun_forum_news\'] = \'<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld\'.(++$forum_page[\'fld_count\']).\'" name="pun_forum_news" value="1"\'.($pun_forum_news_option ? \' checked="checked"\' : \'\').\' /></span> <label for="fld\'.$forum_page[\'fld_count\'].\'">\'.$lang_pun_forum_news[\'Post mark\'].\'</label></div>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_post_qr_add_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;
			if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				$query[\'INSERT\'] .= \', forum_news\';
				$query[\'VALUES\'] .= \', \'.$post_info[\'forum_news\'];
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_optional_fieldset' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$forum_page[\'checkboxes\'][\'pun_forum_news\'] = \'<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld\'.(++$forum_page[\'fld_count\']).\'" name="pun_forum_news" value="1"\'.(isset($_POST[\'pun_forum_news\']) ? \' checked="checked"\' : \'\').\' /></span> <label for="fld\'.$forum_page[\'fld_count\'].\'">\'.$lang_pun_forum_news[\'Post mark\'].\'</label></div>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']): ?>
				<fieldset class="mf-set set2">
					<div class="mf-box checkbox">
						<div class="mf-item"><span class="fld-input"><input type="checkbox" value="1" name="pun_forum_news" id="fld3"></span> <label for="fld3"><?php echo $lang_pun_forum_news[\'Post mark\']; ?></label></div>
					</div>
				</fieldset>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_topic_qr_add_topic_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;
			if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				$query[\'INSERT\'] .= \', forum_news\';
				$query[\'VALUES\'] .= \', \'.$post_info[\'forum_news\'];
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_group_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_profile[\'Register\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="hidden">
					<input type="hidden" name="form_honey_key_id" value="<?php echo $fancy_stop_spam_post_key_id; ?>" />
					<input type="hidden" name="form_fancy_stop_spam_time" value="<?php echo time(); ?>" />
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_password' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
				$forum_page[\'hidden_fields\'][\'form_honey_key_id\'] = \'<input type="hidden" name="form_honey_key_id" value="\'.$fancy_stop_spam_post_key_id.\'" />\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_common[\'Submit\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (empty($errors)) {
				if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_email\'] == \'1\' || $forum_config[\'o_fancy_stop_spam_register_form_sfs_ip\'] == \'1\') {
			 		$fancy_stop_spam = Fancy_stop_spam::singleton();
    				$fancy_stop_spam->check_by_sfs($errors, array(\'email\' => $email1, \'ip\'	=> get_remote_address()));
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Check logs for repeated failed register attempts
			$fancy_stop_spam = Fancy_stop_spam::singleton();
			if (TRUE === $fancy_stop_spam->check_register_honeypot_repeated(get_remote_address())) {
				$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT_REPEATED, $forum_user[\'id\'], get_remote_address());
				message($lang_fancy_stop_spam[\'Register bot message\']);
			}

			// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Register bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						message($lang_fancy_stop_spam[\'Register bot message\']);
					}
				}
			}

			// CHECK FORM FILL TIME
			if ($forum_config[\'o_fancy_stop_spam_register_form_timeout\'] == \'1\') {
				if (!isset($_POST[\'form_fancy_stop_spam_time\'])) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEOUT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Register bot message\']);
				} else {
					$fancy_stop_spam_form_fill_time = time() - intval($_POST[\'form_fancy_stop_spam_time\'], 10);
					if ($fancy_stop_spam_form_fill_time < Fancy_stop_spam::FORM_FILL_MIN_TIME) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEOUT, $forum_user[\'id\'], get_remote_address(), $fancy_stop_spam_form_fill_time);
						$errors[] = $lang_fancy_stop_spam[\'Register bot timeout message\'];
					}
				}
			}

			// CHECK TIMEZONE
			if ($forum_config[\'o_fancy_stop_spam_register_form_timezone\'] == \'1\') {
				if (isset($_POST[\'timezone\']) && $_POST[\'timezone\'] == \'-12\') {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEZONE, $forum_user[\'id\'], get_remote_address(), intval($_POST[\'timezone\'], 10));
					message($lang_fancy_stop_spam[\'Register bot timezone message\']);
				}
			}

			// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') {
				if ($_POST[\'register\'] != $lang_profile[\'Register\'].Fancy_stop_spam::SUBMIT_MARK) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_fancy_stop_spam;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_common[\'Submit\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_fieldset' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="hidden">
					<input type="hidden" name="form_honey_key_id" value="<?php echo $fancy_stop_spam_post_key_id; ?>" />
					<input type="hidden" name="form_fancy_stop_spam_time" value="<?php echo time(); ?>" />
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_delete_user_pre_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($forum_config[\'o_fancy_stop_spam_sfs_api_key\']) && $forum_config[\'o_regs_verify\'] == \'1\') {
			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="fancy_stop_spam_report_to_sfs" value="1" /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Report to sfs\'] ?></label>
					</div>
				</div>
			<?php
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') {
				if ($_POST[\'update\'] != $lang_common[\'Submit\'].Fancy_stop_spam::SUBMIT_MARK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Activate bot message\']);
				}
			}

			// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Activate bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam = Fancy_stop_spam::singleton();
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						message($lang_fancy_stop_spam[\'Activate bot message\']);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_link' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_stop_spam_menu_element = \'<li class="\'.((FORUM_PAGE_SECTION == \'fancy_stop_spam\') ? \'active\' : \'normal\').
					((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'">
					<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_section\']).\'">
						<span>\'.$lang_fancy_stop_spam["Admin section antispam"].\'</span>
					</a>
				</li>\';

			array_insert($forum_page[\'admin_menu\'], \'extensions_manage\', $fancy_stop_spam_menu_element, \'fancy_stop_spam\');

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_modify_main_menu' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\' && $forum_config[\'o_signatures\'] == \'1\') {
				if ($forum_user[\'num_posts\'] < Fancy_stop_spam::NUMBER_POSTS_FOR_SIGNATURE) {
					// HIDE SIGNATURE LINK
					if (isset($forum_page[\'main_menu\'][\'signature\'])) {
						$forum_page[\'main_menu\'][\'signature\'] = \'<li\'.(($section == \'signature\') ? \' class="active hidden"\' : \'\').\' style="display: none;"><a href="\'.forum_link($forum_url[\'profile_signature\'], $id).\'"><span>\'.$lang_profile[\'Section signature\'].\'</span></a></li>\';
					}
				}
			}

			// ADD Antispam section to user profile
			if ($forum_user[\'g_id\'] == FORUM_ADMIN) {
				if (isset($forum_page[\'main_menu\'][\'admin\'])) {
					array_insert($forum_page[\'main_menu\'],
						\'admin\',
						\'<li\'.(($section == \'fancy_stop_spam_profile_section\') ?
						\' class="active"\'
						: \'\').\'><a href="\'.forum_link($forum_url[\'fancy_stop_spam_profile_section\'], $id).\'">
						<span>\'.$lang_fancy_stop_spam[\'Section antispam\'].\'</span>
					</a></li>\', \'fancy_stop_spam_profile_section\');
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_new_password' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_sublink' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN && FORUM_PAGE_SECTION == \'fancy_stop_spam\') {
				// LOGS
				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_logs\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_logs\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_logs\']).\'">\'.$lang_fancy_stop_spam["Admin submenu logs"].\'</a>
					</li>\';

				// NEW USERS
				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_new_users\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_new_users\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_new_users\']).\'">\'.$lang_fancy_stop_spam["Admin submenu new users"].\'</a>
					</li>\';

				// Suspicious USERS
				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_suspicious_users\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_suspicious_users\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_suspicious_users\']).\'">\'.$lang_fancy_stop_spam["Admin submenu suspicious users"].\'</a>
					</li>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_signature_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\') {
				if ($forum_user[\'num_posts\'] < Fancy_stop_spam::NUMBER_POSTS_FOR_SIGNATURE) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_SIGNATURE_HIDDEN, $forum_user[\'id\'], get_remote_address());
					$fancy_stop_spam->mark_user_as_spammer($forum_user[\'id\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_delete_user_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_POST[\'fancy_stop_spam_report_to_sfs\']) && $forum_config[\'o_regs_verify\'] == \'1\') {
				if (!empty($forum_config[\'o_fancy_stop_spam_sfs_api_key\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->send_spam_data_to_sfs($user[\'username\'], $user[\'email\'], $user[\'registration_ip\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aex_section_manage_pre_ext_actions' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($ext[\'id\'] == \'fancy_stop_spam\' && !isset($forum_page[\'ext_actions\'][\'fancy_stop_spam_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_stop_spam_settings\'] = \'
					<span>
						<a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.
							$lang_fancy_stop_spam[\'Go to settings\'].\'
						</a>
					</span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
);

?>