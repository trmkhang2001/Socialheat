<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_006 extends CI_Migration
{

    public function up()
    {
        /**
         * @var $dbForge \ CI_DB_forge;
         */
        $dbForge = $this->dbforge;
        $dbForge->create_table(
            'brand',
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
                        'item_id'    => [
                            'type'       => 'INT',
                            'constraint' => 11,
                            'null'       => FALSE,
                        ],
                        'keywords' => [
                            'type' => 'varchar',
                            'constraint' => 255,
                            'null' => FALSE,
                        ],
                        'rate' => [
                            'type' => 'int',
                            'constraint' => 11,
                            'null' => FALSE,
                        ],
                        'created_date' => [
                            'type' => 'datetime',
                            'null' => FALSE,
                        ]

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
