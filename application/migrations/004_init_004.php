<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_004 extends CI_Migration
{

    public function up()
    {
        /**
         * @var $dbForge \ CI_DB_forge;
         */
        $dbForge = $this->dbforge;
        $dbForge->drop_table('crm');
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
                            'type'       => 'bigint',
                            'null'       => FALSE,
                        ],

                    ]
                ),
                $dbForge->add_key('id', true)
            ]
        );
        $this->db->query('ALTER TABLE  crm ADD UNIQUE INDEX  (`phone`)');
    }

    public function down()
    {
    }
}
