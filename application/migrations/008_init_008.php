<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_008 extends CI_Migration
{

    public function up()
    {
        /**
         * @var $dbForge \ CI_DB_forge;
         */
        $dbForge = $this->dbforge;
        $dbForge->create_table(
            'app',
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
                        'app_name' => [
                            'type' => 'varchar',
                            'constraint' => 255,
                            'null' => FALSE,
                        ],
                    ]
                ),
                $dbForge->add_key('id', true)
            ]
        );
    }

    public function down()
    {
    }
}
