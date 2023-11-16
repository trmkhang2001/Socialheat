<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init extends CI_Migration {

	public function up()
	{
		/**
		 * @var $dbForge \ CI_DB_forge;
		 */
		$dbForge = $this->dbforge;
		$dbForge->add_column(
			'items',
			[
				'charts' => [
					'type'    => 'json',
					'null'    => TRUE
				]
			]
		);

		$dbForge->create_table(
			'miss_interactions',
			true,
			[
				$dbForge->add_field(
					[
						'id'              => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true
						],
						'uid'    => [
							'type'       => 'bigint',
							'null'       => FALSE,
						],
						'item_id'         => [
							'type'           => 'INT',
							'constraint'     => 11,
							'null'       => FALSE,
						],

						'created_date'    => [
							'type' => 'datetime',
							'null' => FALSE,
						]
					]
				),
				$dbForge->add_key('id', true)
			]
		);
		$this->db->query('ALTER TABLE  miss_interactions ADD UNIQUE INDEX  (`uid`,`item_id`)');
	}

	public function down()
	{
	}
}