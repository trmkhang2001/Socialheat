<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_007 extends CI_Migration
{

    public function up()
    {
        /**
         * @var $dbForge \ CI_DB_forge;
         */
        $dbForge = $this->dbforge;
        $dbForge->add_column(
            'users',
            [
                'key' => [
                    'type' => 'varchar',
                    'constraint' => 255,
                    null => true,
                ],
                'app_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    null => true,
                ]
            ]
        );
    }

    public function down()
    {
    }
}
