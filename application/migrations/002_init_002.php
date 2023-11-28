<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_002 extends CI_Migration
{

	public function up()
	{
		/**
		 * @var $dbForge \ CI_DB_forge;
		 */
		$dbForge = $this->dbforge;
		$dbForge->add_column(
			'social_items',
			[
				'is_feature' => [
					'type' => 'bit',
					'null' => TRUE
				]
			]
		);
		$dbForge->modify_column(
			'items',
			[
				'total_share' => [
					'type' => 'int',
					'null' => TRUE
				],
				'total_like' => [
					'type' => 'int',
					'null' => TRUE
				],
				'total_comment' => [
					'type' => 'int',
					'null' => TRUE
				],
				'count_comment' => [
					'type' => 'int',
					'null' => TRUE
				],
				'author' => [
					'type' => 'bigint',
					'null' => TRUE
				],
			]
		);
	}

	public function down()
	{
	}
}
