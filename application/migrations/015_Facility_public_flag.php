<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Facility_public_flag extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('facility',
			array(
				'public_flag' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'unsigned' => TRUE,
					'null' => FALSE,
					'default' => 1
				)
			)
		);
	}

	public function down()
	{
		//
	}

}