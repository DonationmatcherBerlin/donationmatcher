<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Changes extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_column('facility', 'area');

		$this->dbforge->modify_column('facility',
			array(
				'organisation' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'type' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'person_in_charge' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'phone' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'homepage' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'opening_hours' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
				'updated_at' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
			)
		);

		$this->dbforge->modify_column('stock_list_entry',
			array(
				'count' => array(
					'type' => 'INT',
					'contraint' => 11,
					'default' => 0
				)
			)
		);

		$this->dbforge->add_column('facility',
			array(
				'association' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
					'null' => TRUE
				),
			)
		);
	}

	public function down()
	{
		$this->dbforge->drop_column('facility', 'association');

		$this->dbforge->add_column('facility',
			array(
				'area' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
			)
		);

		$this->dbforge->modify_column('facility',
			array(
				'organisation' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'type' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'person_in_charge' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'phone' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'homepage' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'opening_hours' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
				'updated_at' => array(
					'type' => 'VARCHAR',
					'constraint' => 255,
				),
			)
		);

		$this->dbforge->modify_column('stock_list_entry',
			array(
				'count' => array(
					'type' => 'INT',
					'contraint' => 11,
					'null' => TRUE,
				)
			)
		);
	}

}