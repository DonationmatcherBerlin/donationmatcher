<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_stock_list_field_count extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('stock_list_entry',
			array(
				'count' => array(
					'type' => 'INT',
					'contraint' => 11,
					'null' => TRUE
				)
			)
		);	
	}

	public function down()
	{
		$this->dbforge->drop_column('stock_list_entry', 'count');
	}

}