<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Category_fixes extends CI_Migration
{
	public function up()
	{
		$this->dbforge->modify_column('category',
			array(
				'Parent' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'null' => TRUE
				)
			)
		);	
	}

	public function down()
	{
		$this->dbforge->modify_column('category',
			array(
				'Parent' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE
				)
			)
		);
	}

}