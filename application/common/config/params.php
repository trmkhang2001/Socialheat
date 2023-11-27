<?php
/*Item per page*/
define('ITEM_PER_PAGE_5', 5);
define('ITEM_PER_PAGE_9', 9);
define('ITEM_PER_PAGE_10', 10);
define('ITEM_PER_PAGE_14', 14);
define('ITEM_PER_PAGE_28', 28);
define('ITEM_PER_PAGE_20', 20);
define('ITEM_PER_PAGE_30', 30);
define('ITEM_PER_PAGE_32', 32);
define('ITEM_PER_PAGE_40', 40);
define('ITEM_PER_PAGE_50', 50);
define('ITEM_PER_PAGE_100', 100);
define('DEFAULT_ITEM_PER_PAGE', ITEM_PER_PAGE_10);
define('STATUS_ACTIVE', 10);
define('STATUS_DEACTIVE', 1);
define('STATUS_DELETE', 0); // khi do bi xoa

define('STATUS_API_SUCCESS', 1);
define('STATUS_API_ERROR', 0);

define('ROLE_ADMIN', '1'); // role admin id
define('ROLE_NORMAL', '2'); // role normal id
define('ROLE_CLIENTS', '3'); // role clients id
define('ROLE_DOWNLOAD', '4'); // role clients id
define('SYSTEM_DELETE', 1); // co xoa khoi he thong hay khong (=1 xoa vinh vien)
define('UPLOAD_BASE_DIR', FCPATH);
define('UPLOAD_BASE', 'uploads/');
define('UPLOAD_BASE_IMAGES', 'images/posts/');

define('UPLOAD_TMP_DIR', 'tmp/');
define('UPLOAD_THUMBNAIL_FOLDER', 'thumbs/');

//CLIENTS TYPE API
define('CLIENT_TYPE_API', 'api');
define('CLIENT_TYPE_EXTENSION', 'extension');
//other
define('DATE_STRING_FORMAT', 'd-m-Y');

define('CACHE_OBJECT_EXPIRED_SECONDS_SHORT', 600);
define('CACHE_OBJECT_EXPIRED_SECONDS_ONE_HOUR', 3600);
define('CACHE_STATIC_EXPIRED_SECONDS', 36000);

define('CACHE_KEY_PREFIX_PHONE', 'phone_');
define('CACHE_KEY_PREFIX_UID', 'uid_');
define('CACHE_KEY_PREFIX_POST', 'post_');
define('ITEM_TYPE_FANPGAE', '1');
define('ITEM_TYPE_GROUP', '2');
define('ITEM_TYPE_PROFILE', '3');
define('ACCESS_TOKEN', '123@datalytis');
define('IMPORT_ACCESS_TOKEN', '123@datalytis');
define('DATE_TIME_FORMAT', 'Y-m-d H:i:s');
//define('URL_API_FLASH','http://dev.api-flash79.com/');
//define('URL_API_FLASH', 'http://api.flash79.net/');
define('URL_API_FLASH', 'http://api.datalytis.com/');


//define('USER_API_FLASH', 'dohungmy@gmail.com');
//define('PASSWORD_API_FLASH', '123456');
//define('USER_TOKEN_API', '$2y$10$FjCdVw9SwxJoqncpQZqST.kJWs6F8DGp89U3ze6leeA9dw3dDpAqu');

//define('USER_API_FLASH', 'flash7999@gmail.com');
//define('PASSWORD_API_FLASH', '123456');
//define('USER_TOKEN_API', '$2y$10$jtzPoTpXqJU1iaXjHUzdjeEKOsRxSHXrXOUzLkIjo542cmZxxTL0O');
define('USER_API_FLASH', 'flash7992@gmail.com');
define('PASSWORD_API_FLASH', '123456');
define('USER_TOKEN_API', '$2y$10$sfTBlUPNc1STbHAbNJIQoeESlwDjCzGu19LKR/sGKAqDw26FrIlye');

//define('DB_NAME_SELECT_API','flash79,db_social');
// type tool xpath
define('DB_NAME_SELECT_API', 'flash79');
define('XPATH_TYPE_TOOL_SLP', '1');
define('XPATH_TYPE_TOOL_POST_INTERACTION', '2');
define('XPATH_TYPE_TOOL_POST_FB_TOKEN', '3');
define('XPATH_TYPE_TOOL_TWITTER', '4');
define('XPATH_TYPE_TOOL_INSTAGRAM', '5');
define('XPATH_TYPE_TOOL_TELEGRAM', '6');
//type
define('XPATH_TYPE_FANPAGE', '1'); //fanpge
define('XPATH_TYPE_PROFILE', '2'); //profile
define('XPATH_TYPE_GROUP', '3'); //GROUP


define('XPATH', 'xpath');
//api pusher
define('PUSHER_AUTH_KEY', 'b65e51ac3077c839fced');
define('PUSHER_SECRET', 'ed48447d49aa09c4912e');
define('PUSHER_APP_ID', '1225371');
define('CHANNEL_TYPE_FACEBOOK', '0');
define('CHANNEL_TYPE_INSTAGRAM', '1');
define('CHANNEL_TYPE_TELEGRAM', '2');
define('CHANNEL_TYPE_TWITTER', '3');
define('CHANNEL_TYPE_FACEBOOK_INTERACTION', '4');
define('CHANNEL_TYPE_FACEBOOK_TOKEN', '5');
define('CHANNEL_TYPE_FACEBOOK_COMMENT', '6');
define('CHANNEL_TYPE_INSTAGRAM_AUTO_COMMENT', '7');
define('CHANNEL_TYPE_TIKTOK', '8');
// token fb
define('FB_TOKEN', '885406751667812|9972e3ce54ec4934f23a5baac12637a3');

// status comment reports
define('COMMENT_REPORT_STATUS_PENDING', '0');
define('COMMENT_REPORT_STATUS_SUCCESS', '1');
define('COMMENT_REPORT_STATUS_ERROR', '2');



const BUCKET_NAME_ADSSPY = 'thealita';
const API_USER_INFO_URL = 'https://api.datalytis.com/';
const API_USER_INFO_MAIL = 'mightysocial@datasium.io';
const API_USER_INFO_TOKEN = '$2y$10$HvT76Yd68BRqHtM1FiuOJOig7jEJQV4Wpe6MQ79eqAcayvOgLNb2y';
const API_GET_USER_INFO_BY_PHONE
= API_USER_INFO_URL . 'phone?email=' . API_USER_INFO_MAIL . '&token=' . API_USER_INFO_TOKEN . '&phone=';



const API_GET_USER_INFO_BY_UIDS
= API_USER_INFO_URL . 'uids?email=' . API_USER_INFO_MAIL . '&token=' . API_USER_INFO_TOKEN . '&uids=';

return array(
	'user_role'             => array(
		ROLE_ADMIN    => array(
			'id'   => ROLE_ADMIN,
			'name' => 'Admin',
			'slug' => 'supper-admin'
		),
		ROLE_NORMAL   => array(
			'id'   => ROLE_NORMAL,
			'name' => 'Premium',
			'slug' => 'premium'
		),
		ROLE_CLIENTS  => array(
			'id'   => ROLE_CLIENTS,
			'name' => 'User',
			'slug' => 'user'
		),
		ROLE_DOWNLOAD => array(
			'id'   => ROLE_DOWNLOAD,
			'name' => 'Download',
			'slug' => 'download'
		),
	),
	'clients_type'          => [
		CLIENT_TYPE_API       => [
			'name'  => CLIENT_TYPE_API,
			'value' => CLIENT_TYPE_API
		],
		CLIENT_TYPE_EXTENSION => [
			'name'  => CLIENT_TYPE_EXTENSION,
			'value' => CLIENT_TYPE_EXTENSION
		],
	],
	'list_status'           => [
		STATUS_ACTIVE   => [
			'name'  => 'Active',
			'class' => 'text-success',
			'value' => STATUS_ACTIVE
		],
		STATUS_DEACTIVE => [
			'name'  => 'Deactive',
			'class' => 'text-danger',
			'value' => STATUS_DEACTIVE
		]
	],
	'types'                 => [
		'1' => [
			'name'  => 'Fanpage',
			'value' => '1',
			'color' => '#F7BF47'

		],
		'2' => [
			'name'  => 'Group',
			'value' => '2',
			'color' => '#00C597'
		],
		'3' => [
			'name'  => 'Profile',
			'value' => '3',
			'color' => '#4778F7'
		]
	],
	'channel_types'         => [
		CHANNEL_TYPE_FACEBOOK  => [
			'name'       => 'Facebook',
			'value'      => CHANNEL_TYPE_FACEBOOK,
			'icon_image' => '/assets/images/icon-fb.png',
			'link'       => 'https://facebook.com/',
			'color'      => '#4778F7',
		],
		CHANNEL_TYPE_INSTAGRAM => [
			'name'       => 'Instagram',
			'value'      => CHANNEL_TYPE_INSTAGRAM,
			'icon_image' => '/assets/images/icon-instagram.png',
			'link'       => 'https://www.instagram.com/',
			'color'      => '#f7504f'
		],
		CHANNEL_TYPE_TELEGRAM  => [
			'name'       => 'Telegram',
			'value'      => CHANNEL_TYPE_TELEGRAM,
			'icon_image' => '/assets/images/icon-telegram.png',
			'link'       => 'https://web.telegram.org/',
			'color'      => '#4e96d4'

		],
		CHANNEL_TYPE_TWITTER   => [
			'name'       => 'Twitter',
			'value'      => CHANNEL_TYPE_TWITTER,
			'icon_image' => '/assets/images/icon-twitter.png',
			'link'       => 'https://twitter.com/',
			'color'      => '#1da1f1'
		],
		CHANNEL_TYPE_TIKTOK   => [
			'name'       => 'Tiktok',
			'value'      => CHANNEL_TYPE_TIKTOK,
			'icon_image' => '/assets/images/icon-tiktok.png',
			'link'       => 'https://www.tiktok.com/',
			'color'      => '#24f3ee'
		],

	],
	'comment_report_status' => [
		COMMENT_REPORT_STATUS_PENDING => [
			'name'  => 'Pending',
			'class' => 'text-warning',
			'value' => COMMENT_REPORT_STATUS_PENDING
		],
		COMMENT_REPORT_STATUS_ERROR   => [
			'name'  => 'Error',
			'class' => 'text-danger',
			'value' => COMMENT_REPORT_STATUS_ERROR
		],
		COMMENT_REPORT_STATUS_SUCCESS => [
			'name'  => 'Success',
			'class' => 'text-success',
			'value' => COMMENT_REPORT_STATUS_SUCCESS
		]
	],
	XPATH                   => [
		'channel_type' => [
			CHANNEL_TYPE_FACEBOOK               => [
				'name'  => 'Facebook',
				'value' => CHANNEL_TYPE_FACEBOOK,
			],
			CHANNEL_TYPE_INSTAGRAM              => [
				'name'  => 'Instagram',
				'value' => CHANNEL_TYPE_INSTAGRAM,
			],
			CHANNEL_TYPE_TELEGRAM               => [
				'name'  => 'Telegram',
				'value' => CHANNEL_TYPE_TELEGRAM,
			],
			CHANNEL_TYPE_TWITTER                => [
				'name'  => 'Twitter',
				'value' => CHANNEL_TYPE_TWITTER,
			],
			CHANNEL_TYPE_FACEBOOK_INTERACTION   => [
				'name'  => 'Facebook Interaction',
				'value' => CHANNEL_TYPE_FACEBOOK_INTERACTION,
			],
			CHANNEL_TYPE_FACEBOOK_COMMENT       => [
				'name'  => 'Facebook Comment',
				'value' => CHANNEL_TYPE_FACEBOOK_COMMENT,
			],
			CHANNEL_TYPE_INSTAGRAM_AUTO_COMMENT => [
				'name'  => 'Instagram Auto Comment',
				'value' => CHANNEL_TYPE_INSTAGRAM_AUTO_COMMENT,
			],
			CHANNEL_TYPE_TIKTOK => [
				'name'  => 'Tiktok',
				'value' => CHANNEL_TYPE_TIKTOK,
			],
		],
		'types'        => [
			XPATH_TYPE_FANPAGE => [
				'name'  => 'fanpage',
				'value' => XPATH_TYPE_FANPAGE
			],
			XPATH_TYPE_PROFILE => [
				'name'  => 'profile',
				'value' => XPATH_TYPE_PROFILE,
			],
			XPATH_TYPE_GROUP   => [
				'name'  => 'group',
				'value' => XPATH_TYPE_GROUP,
			],

		],
	],
);
