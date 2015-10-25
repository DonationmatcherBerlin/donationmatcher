<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_stock_list_fields extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('stock_list_entry',
			array(
				'comment' => array(
					'type' => 'TEXT',
					'null' => TRUE
				)
			)
		);	
	}

	public function down()
	{
		$this->dbforge->drop_column('stock_list_entry', 'comment');
	}

}