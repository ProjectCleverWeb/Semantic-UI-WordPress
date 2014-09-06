<?php

define('DB_NAME', 'semantic');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         '7UzOnWV3%f_&0C>!o|r{$+T0dLpR91`|!9)p<o;~&/+l<|CQJGM]wUxJr&ZhbxF&');
define('SECURE_AUTH_KEY',  'JfwR=1lqPGeAxH3g1&~p,aK.+cKn%oC;6-u4 |T,)z<QyE@HO+b;`{?5p,dz1t0k');
define('LOGGED_IN_KEY',    'uX:Wt>|$tr*nc~Tq#i7hzk8r$!lp-!{6NM`T:Vpt_2^}zWX<vhnEv6=$pk]|71Hy');
define('NONCE_KEY',        'UmM3|fRT3X6 Y` A//9c2QW!SStu!tD)6xn$dj{),?z,+Nv9+yUI;b@9Fe+~Tbo ');
define('AUTH_SALT',        'r1n3c7izyu`DDkCW^M4c 5uS9vv~R1BS-`T?B>4Ca6XLv: [pTkwTDa)x7*>xg6!');
define('SECURE_AUTH_SALT', '0wOi4TdcJ:lSGEKB7pKQR:~ZG;|4D|CB3EDT,Mm+?WDRQF>6ZaU3oxoj-su!5ebz');
define('LOGGED_IN_SALT',   'AJCX%~rC`h9YjLegg#|0+Jw|@nF,u)p|h;Rd<AR>_KQW,>NDWpb*IaAwT;6;rRTS');
define('NONCE_SALT',       '|o<pvcFu`O[x>Jwv{G|+[2d]iBV0f25|ump kWM9HN^JJ%V0{%%//iCvI |{oucO');

$table_prefix  = 'wp_';

define('WPLANG', '');

define('WP_DEBUG', FALSE);

if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__.'/');
}

require_once(ABSPATH . 'wp-settings.php');
