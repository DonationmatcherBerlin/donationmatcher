<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_category extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'category_id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'Parent' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'null' => TRUE
				)
			)
		);

		$this->dbforge->add_key('category_id', true);
		$this->dbforge->add_key('Parent');
		$this->dbforge->create_table('category');

		$this->db->query('
			ALTER TABLE category
				ADD CONSTRAINT fk_idx_category_Parent FOREIGN KEY (Parent) REFERENCES category(category_id) ON DELETE CASCADE;
		');
	}

	public function down()
	{
		$this->dbforge->drop_table('category');
	}

}