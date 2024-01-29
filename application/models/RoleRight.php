<?php

namespace app\models;

class RoleRight extends MyModel
{

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return RoleRight object
	 */
	static public function getInstance()
	{
		if (self::$_instance === NULL) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	static public function clearInstance()
	{
		self::$_instance = NULL;
	}

	public static function tableName()
	{
		return 'role_rights';
	}

	public static function getRights()
	{
		return array(
			ROLE_CLIENTS  => array(
				// 'clients/index',
				// 'clients/reports',
				// 'clients/instagram',
				// 'clients/twitter',
				// 'clients/facebook',
				// 'clients/detail',
				// 'clients/get_last_item',
				// 'clients/getDataCity',
				// 'clients/ajax',
				// 'clients/get_info_uids',
				'dashboards/index',
				'monitoring/index',
				'monitoring/detail',
				'monitoring/downloads',
				'interactions/index',
				'trending/index',
				// 'socialitems/index',
				'socialitems/clients',
				'profile/index',
			),
			ROLE_NORMAL   => array(
				// 'clients/index',
				// 'clients/detail',
				// 'clients/get_last_item',
				// 'clients/getDataCity',
				// 'clients/ajax',
				// 'clients/get_info_uids',
				'dashboards/index',
				'monitoring/index',
				'monitoring/detail',
				'interactions/index',
				'trending/index',
				'socialitems/index',
				'profile/index',
			),
			ROLE_DOWNLOAD => array(
				// 'clients/index',
				// 'clients/reports',
				// 'clients/instagram',
				// 'clients/twitter',
				// 'clients/facebook',
				// 'clients/detail',
				// 'clients/get_last_item',
				// 'clients/getDataCity',
				// 'clients/ajax',
				// 'clients/get_info_uids',
				'dashboards/index',
				'monitoring/index',
				'monitoring/detail',
				'interactions/index',
				'interactions/download',
				'trending/index',
				'socialitems/index',
				'profile/index',
			)
		);
	}
}
