<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_additional_facility_fields extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('facility', 
			array(
				'zip' => 
					array(
						'type' => 'VARCHAR',
						'constraint' => 255,
						'null' => false
					),
				'city' => 
					array(
						'type' => 'VARCHAR',
						'constraint' => 255,
						'null' => false
					),
				'country' => 
					array(
						'type' => 'VARCHAR',
						'constraint' => 255,
						'null' => false,
						'default' => 'Germany'
					)
			)
		);	
	}

	public function down()
	{
		$this->dbforge->drop_column('facility', 'zip');
		$this->dbforge->drop_column('facility', 'city');
		$this->dbforge->drop_column('facility', 'country');
	}

}