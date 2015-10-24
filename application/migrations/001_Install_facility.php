<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_facility extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(
			array(
				'facility_id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'User' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE
				),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'organisation' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'homepage' => array(
					'type' => 'VARCHAR',
					'constraint' => 2083
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'phone' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'area' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'address' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'opening_hours' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'person_in_charge' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'type' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'created_at' => array(
					'type' => 'datetime',
					'default' => '0000-00-00 00:00:00'
				),
				'updated_at' => array(
					'type' => 'datetime',
					'default' => '0000-00-00 00:00:00'
				)
			)
		);

		$this->dbforge->add_key('facility_id', true);
		$this->dbforge->create_table('facility');
	}

	public function down()
	{
		$this->dbforge->drop_table('facility');
	}

}