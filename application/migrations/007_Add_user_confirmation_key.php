<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user_confirmation_key extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('users', 
			array(
				'confirmation_key' => 
					array(
						'type' => 'VARCHAR',
						'constraint' => 255,
						'null' => false
					)
			)
		);	
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'confirmation_key');
	}

}