<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_stock_list_entry extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'stock_list_entry_id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'StockList' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE
				),
				'Category' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE
				),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => 255
				),
				'demand' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'default' => 0,
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

		$this->dbforge->add_key('stock_list_entry_id', true);
		$this->dbforge->add_key('StockList');
		$this->dbforge->add_key('Category');
		$this->dbforge->create_table('stock_list_entry');

		$this->db->query('
			ALTER TABLE stock_list_entry
				ADD CONSTRAINT fk_idx_stock_list_entry_StockList FOREIGN KEY (StockList) REFERENCES stock_list(stock_list_id) ON DELETE CASCADE,
				ADD CONSTRAINT fk_idx_stock_list_entry_Category FOREIGN KEY (Category) REFERENCES category(category_id) ON DELETE CASCADE;
		');
	}

	public function down()
	{
		$this->dbforge->drop_table('stock_list_entry');
	}

}