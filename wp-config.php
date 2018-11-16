<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'karat');

/** Имя пользователя MySQL */
define('DB_USER', 'karat');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'YzKdEI3DItbGLdHd');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'B<KkZL&/&>@u&e_BHf>(d6l A6%k+3AZBf[XgCKm4CzE?!yO^CKgG:g}!]N{Cr].');
define('SECURE_AUTH_KEY',  'xUw2`~d#1RGfLL$hXsw_YrGCzAec0v+eA]gGV`s2X=!emh|q*<3E$XWSON@/*070');
define('LOGGED_IN_KEY',    '5|>hyYSF<&.PAk85RJE7Gq>DMw;*R!B&cY7[.p`i{CZLY2uOf&lSUh-;)FZWSvp0');
define('NONCE_KEY',        '7<5^#l5DI2lX^R|J_:6pV*Of41(dr.F7c=.H3Ro.^I+2Ie#Xppf1Zczf9xGXNYX;');
define('AUTH_SALT',        '&ouykzz$yS<:LXu`pPZzvSnd>!l+S]e`hI~@I_mYA&[cX;*GR[4,Vi^QNPBD?xa.');
define('SECURE_AUTH_SALT', 'QlV%:NC3(1>K=svkH%<Qjmt$4X ImC /A9mwEt1j88~g;C0{RMP.^:_,=%&~+Uf&');
define('LOGGED_IN_SALT',   'X[fu3}GUdg2CK&1$@Tj<Wh]JhZNs)v:Ae7t0h?zAlhH~^o IW~^5koq2,8G$tf,G');
define('NONCE_SALT',       'elDNrM;5v22}LOq{cA)Pu}#UK5 >~Y$]6NL]:C0DM1~dNg3/eRd6$>DA?237E,t>');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
