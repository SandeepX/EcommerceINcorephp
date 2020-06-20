<?php


ob_start();
session_start();



if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR']== "::1"){
	define('ENVIRONMENT', 'DEVELOPMENT');
} else {
	define('ENVIRONMENT', 'PRODUCTION');
}

if(ENVIRONMENT == 'DEVELOPMENT'){
	error_reporting(E_ALL);

	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PWD','');
	define('DB_NAME','dokan');

} else {
	error_reporting(0);

	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PWD','');
	define('DB_NAME','dokan');
}

/*Common Consts*/
$site_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";

define('SITE_URL', $site_url);
define('CONFIG_PATH', $_SERVER['DOCUMENT_ROOT'].'config/');
define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'class/');
define('ERROR_PATH', $_SERVER['DOCUMENT_ROOT'].'error/');

define('ASSETS_URL', SITE_URL.'assets/');
define('ALLOWED_EXTENSION', array('jpg','jpeg','png','gif','svg'));

define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'uploads/');
define('UPLOAD_URL', SITE_URL.'uploads/');
/*Common Consts*/



/*Backend Consts*/
define('CMS_URL', SITE_URL.'cms/');
define('ADMIN_ASSETS_URL', ASSETS_URL.'cms/');
define('ADMIN_CSS_URL', ADMIN_ASSETS_URL.'css/');
define('ADMIN_JS_URL', ADMIN_ASSETS_URL.'js/');
define('ADMIN_IMAGES_URL', ADMIN_ASSETS_URL.'images/');

define('ADMIN_PAGE_TITLE', 'Admin Panel');
/*Backend Consts*/



/*Frontend Consts*/
define('FRONT_ASSETS_URL', ASSETS_URL.'frontend/');
define('FRONT_CSS_URL', FRONT_ASSETS_URL.'css/');
define('FRONT_JS_URL', FRONT_ASSETS_URL.'js/');
define('FRONT_IMAGES_URL', FRONT_ASSETS_URL.'img/');


define('SITE_TITLE', 'Dokan.com, a complete shop for your daily purpose.');
define('META_KEYWORDS', 'dokan, pasale, ecommerce, nepali ecommerce, nepal, shop, online ecommerce, electronics, camera, smartphones, clothes, fashion');
define('META_DESCRIPTION', 'Dokan.com is the one and only first Nepali ecommerce website with all your daily goods and consumables.');

/*For facebook share*/
define('OG_URL', SITE_URL);
define('OG_TITLE', SITE_TITLE);
define('OG_DESCRIPTION', META_DESCRIPTION);
define('OG_IMAGE', FRONT_IMAGES_URL.'logo.png');
define('OG_TYPE','article');
/*Frontend Consts*/