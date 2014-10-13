<?php

// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'			=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_identifier'			=>	'uk',

// Number formatting
'lang_decimal_point'		=>	',',
'lang_thousands_sep'		=>	' ',

// Notices
'Bad request'				=>	'Хибний запит. Посилання некоректне або застаріле.',
'No view'				=>	'Ви не маєте прав доступу для перегляду цих форумів.',
'No permission'				=>	'Ви не маєте прав доступу до цієї сторінки.',
'CSRF token mismatch'		=>	'Неможливо підтвердити безпеку з\'єднання. Вірогідно це трапилось через те, що між входом на сторінку та відправленням даних минув деякий час. Якщо ви бажаєте продовжити виконання дії, будь ласка, натисніть на кнопку Підтвердити. В іншому випадку ви маєте натиснути на кнопку Скасувати, щоб повернутися у те місце, де перебували.',
'No cookie'				=>	'Здається ви зареєструвалися успішно, проте cookie не були встановлені. Будь ласка, перевірте параметри налаштування та, якщо це можливо, увімкніть cookie для цього веб-сайту.',


// Miscellaneous
'Forum index'				=>	'Список форумів',
'Submit'					=>	'Надіслати',	// "name" of submit buttons
'Cancel'					=>	'Скасувати', // "name" of cancel buttons
'Preview'					=>	'Попередній перегляд',	// submit button to preview message
'Delete'					=>	'Видалити',
'Split'						=>	'Розбити',
'Ban message'				=>	'Ви були забанені на цьому форумі.',
'Ban message 2'				=>	'Термін закінчення бану %s.',
'Ban message 3'				=>	'Адміністратор або модератор, який вас забанив, залишив таке повідомлення:',
'Ban message 4'				=>	'Будь ласка, спрямовуйте будь-які запити до адміністратора форуму за адресою %s.',
'Never'						=>	'Ніколи',
'Today'						=>	'Сьогодні',
'Yesterday'					=>	'Вчора',
'Forum message'				=>	'Повідомлення форуму',
'Maintenance warning'		=>	'<strong>УВАГА! %s увімкнено.</strong> НЕ ВИХОДЬТЕ З ФОРУМУ, оскільки ви не зможете увійти до форуму знову.',
'Maintenance mode'			=>	'Режим обслуговування',
'Redirecting'				=>	' Перенаправлення...',
'Forwarding info'			=>	'Вас буде автоматично перенаправлено на нову сторінку за %s %s.',
'second'					=>	'секунду',	// singular
'seconds'					=>	'секунд(и)',	// plural
'Click redirect'			=>	'Натисніть сюди, якщо ви не бажаєте чекати довше (або якщо ваш переглядач не пересилає вас автоматично)',
'Invalid e-mail'			=>	'Ви ввели хибну e-mail адресу.',
'New posts'					=>	'Нові повідомлення',	// the link that leads to the first new post
'New posts title'			=>	'Знайти теми, які містять повідомлення, залишені з моменту вашого останнього візиту.',	// the popup text for new posts links
'Active topics'				=>	'Активні теми',
'Active topics title'		=>	'Знайти теми, які містять останні повідомлення.',
'Unanswered topics'			=>	'Теми без відповідей',
'Unanswered topics title'	=>	'Знайти теми без відповідей.',
'Username'					=>	'Ім\'я користувача',
'Registered'				=>	'Зареєстровано',
'Write message'				=>	'Напишіть повідомлення:',
'Forum'						=>	'Форум',
'Posts'						=>	'Повідомлення',
'Pages'						=>	'Сторінки',
'Page'						=>	'Сторінка',
'BBCode'					=>	'BBCode',	// You probably shouldn't change this
'Smilies'					=>	'Смайли',
'Images'					=>	'Зображення',
'You may use'				=>	'Ви можете використовувати: %s',
'and'						=>	'та',
'Image link'				=>	'зображення',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'						=>	'написав',	// For [quote]'s (e.g., User wrote:)
'Code'						=>	'Код',		// For [code]'s
'Forum mailer'				=>	'%s поштовик',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Write message legend'		=>	'Додайте ваше повідомлення',
'Required information'		=>	'Необхідна інформація',
'Reqmark'					=>	'*',
'Required warn'				=>	'All fields with bold label must be completed before the form is submitted.',
'Crumb separator'			=>	' &rarr;&#160;', // The character or text that separates links in breadcrumbs
'Title separator'			=>	' - ',
'Page separator'			=>	'&#160;', //The character or text that separates page numbers
'Spacer'					=>	'…', // Ellipsis for paginate
'Paging separator'			=>	' ', //The character or text that separates page numbers for page navigation generally
'Previous'					=>	'Попередня',
'Next'						=>	'Наступна',
'Cancel redirect'			=>	'Операція скасована.',
'No confirm redirect'		=>	'Підтвердження не забезпечено. Дію скасовано. Перенаправлення...',
'Please confirm'			=>	'Будь ласка, підтвердіть:',
'Help page'					=>	'Допомога: %s',
'Re'						=>	'Re:',
'Page info'					=>	'(Сторінка %1$s з %2$s)',
'Item info single'			=>	'%s: %s',
'Item info plural'			=>	'%s: з %s по %s з %s', // e.g. Topics [ 10 to 20 of 30 ]
'Info separator'			=>	' ', // e.g. 1 Page | 10 Topics
'Powered by'				=>	'Використовується %s, підтримка %s.',
'Maintenance'				=>	'Обслуговування',
'Installed extension'		=>	'The %s official extension is installed. Copyright &copy; 2003&ndash;2012 <a href="http://punbb.informer.com/">PunBB</a>.',
'Installed extensions'		=>	'Currently installed <span id="extensions-used" title="%s">%s official extensions</span>. Copyright &copy; 2003&ndash;2012 <a href="http://punbb.informer.com/">PunBB</a>.',

// CSRF confirmation form
'Confirm'					=>	'Підтвердити',	// Button
'Confirm action'			=>	'Підтвердити дію',
'Confirm action head'		=>	'Будь ласка, підтвердіть або скасуйте вашу останню дію',

// Title
'Title'						=>	'Заголовок',
'Member'					=>	'Користувач',	// Default title
'Moderator'					=>	'Модератор',
'Administrator'				=>	'Адміністратор',
'Banned'					=>	'Заблокований',
'Guest'						=>	'Гість',

// Stuff for include/parser.php
'BBCode error 1'			=>	'[/%1$s] було знайдено без співпадінь [%1$s]',
'BBCode error 2'			=>	'Тег [%s] порожній',	//tag is empty
'BBCode error 3'			=>	'[%1$s] було відкрито всередині [%2$s], що не дозволено',
'BBCode error 4'			=>	'[%s] було відкрито всередині себе, що не дозволено',
'BBCode error 5'			=>	'[%1$s] було знайдено без співпадінь [/%1$s]',
'BBCode error 6'			=>	'Тег [%s] має порожню секцію властивостей',
'BBCode nested list'		=>	'Теги [list] не можуть бути вкладені',
'BBCode code problem'		=>	'Проблема з тегами [code]',

// Stuff for the navigator (top of every page)
'Index'						=>	'Форум',
'User list'					=>	'Список користувачів',
'Rules'						=>	'Правила форуму',
'Search'					=>	'Пошук',
'Register'					=>	'Реєстрація',
'register'					=>	'зареєструватися',
'Login'						=>	'Вхід',
'login'						=>	'увійти',
'Not logged in'				=>	'Ви не увійшли.',
'Profile'					=>	'Профіль',
'Logout'					=>	'Вийти',
'Logged in as'				=>	'Ви увійшли як %s.',
'Admin'						=>	'Адміністрування',
'Last visit'				=>	'Останній візит %s',
'Mark all as read'			=>	'Відмітити всі теми прочитаними',
'Login nag'					=>	'Будь ласка, увійдіть або зареєструйтесь.',
'New reports'				=>	'Нові повідомлення',

// Alerts
'New alerts'				=>	'Нові попередження',
'Maintenance alert'			=>	'<strong>Maintenance mode enabled.</strong> <em>DO NOT</em> logout, if you do you will not be able to login again.',
'Updates'					=>	'PunBB updates:',
'Updates failed'			=>	'The latest attempt at checking for updates against the punbb.informer.com updates service failed. This probably just means that the service is temporarily overloaded or out of order. However, if this alert does not disappear within a day or two, you should disable the automatic check for updates and check for updates manually in the future.',
'Updates version n hf'		=>	'A newer version of PunBB, version %s, is available for download at <a href="http://punbb.informer.com/">punbb.informer.com</a>. Furthermore, one or more hotfixes are available for install on the <a href="%s">Manage hotfixes</a> tab of the admin interface.',
'Updates version'			=>	'A newer version of PunBB, version %s, is available for download at <a href="http://punbb.informer.com/">punbb.informer.com</a>.',
'Updates hf'				=>	'One or more hotfixes are available for install on the <a href="%s">Manage hotfixes</a> tab of the admin interface.',
'Database mismatch'			=>	'Database version mismatch',
'Database mismatch alert'	=>	'Your PunBB database is meant to be used in conjunction with a newer version of the PunBB code. This mismatch can lead to your forum not working properly. It is suggested that you upgrade your forum to the newest version of PunBB.',

// Stuff for Jump Menu
'Go'						=>	'Перейти',		// submit button in forum jump
'Jump to'					=>	'Перейти до форуму:',

// For extern.php RSS feed
'RSS description'			=>	'Останні теми в %s.',
'RSS description topic'		=>	'Останні повідомлення в %s.',
'RSS reply'					=>	'Re: ',	// The topic subject will be appended to this string (to signify a reply)

// Accessibility
'Skip to content'			=>	'Перейти до вмісту форуму',

// Debug information
'Querytime'					=>	'Generated in %1$s seconds (%2$s%% PHP - %3$s%% DB) with %4$s queries',
'Debug table'				=>	'Debug information',
'Debug summary'				=>	'Database query performance information',
'Query times'				=>	'Time (s)',
'Query'						=>	'Query',
'Total query time'			=>	'Total query time',

// Error message
'Forum error header'		=> 'Вибачте! Сторінка не може бути відображена.',
'Forum error description'	=> 'Це можливо тимчасова помилка. Спробуйте оновити сторінку. Якщо помилка не зникла, спробуйте через 5-10 хв.',
'Forum error location'		=> 'Помилка в рядку %1$s %2$s',
'Forum error db reported'	=> 'Помилка бази даних:',
'Forum error db query'		=> 'Помилка запиту до бази даних:',

);
