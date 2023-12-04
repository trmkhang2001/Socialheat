<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_003 extends CI_Migration
{

    public function up()
    {
        /**
         * @var $dbForge \ CI_DB_forge;
         */
        $dbForge = $this->dbforge;
        $dbForge->create_table(
            'crm',
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
                        'phone'    => [
                            'type'       => 'varchar',
                            'constraint' => 255,
                            'null'       => FALSE,
                        ],
                        'status' => [
                            'type' => 'int',
                            'constraint' => 11,
                            'null' => TRUE,
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
        $this->db->query('ALTER TABLE  crm ADD UNIQUE INDEX  (`id`,`phone`)');
    }

    public function down()
    {
    }
}
