<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_stock_list extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'stock_list_id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'Facility' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE
				),
				'created_at' => array(
					'type' => 'datetime',
				),
				'updated_at' => array(
					'type' => 'datetime',
					'null' => TRUE
				)
			)
		);

		$this->dbforge->add_key('stock_list_id', true);
		$this->dbforge->add_key('Facility');
		$this->dbforge->create_table('stock_list');

		$this->db->query('
			ALTER TABLE stock_list
				ADD CONSTRAINT fk_idx_stock_list_Facility FOREIGN KEY (Facility) REFERENCES facility(facility_id) ON DELETE CASCADE;
		');
	}

	public function down()
	{
		$this->dbforge->drop_table('stock_list');
	}

}