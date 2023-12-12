<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Init_005 extends CI_Migration
{

    public function up()
    {
		$this->db->query('ALTER TABLE  miss_interactions ADD  INDEX  (`item_id`)');

	}

    public function down()
    {
    }
}
