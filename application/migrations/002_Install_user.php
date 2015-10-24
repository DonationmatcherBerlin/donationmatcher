<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_user extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array(
					'type' => 'int',
					'constraint' => '11',
					'unsigned' => true,
					'null' => false, 
					'auto_increment' => true,
				),
				'username' => array(
					'type' => 'varchar',
					'constraint' => '255',
					'null' => false, 
					'default' => '',
				),
				'email' => array(
					'type' => 'varchar',
					'constraint' => '255',
					'null' => false, 
					'default' => '',
				),
				'password' => array(
					'type' => 'varchar',
					'constraint' => '255',
					'null' => false, 
					'default' => '',
				),
				'avatar' => array(
					'type' => 'varchar',
					'constraint' => '255',
					'default' => 'default.jpg',
				),
				'created_at' => array(
					'type' => 'datetime',
					'null' => false,
				),
				'updated_at' => array(
					'type' => 'datetime',
					'null' => true,
				),
				'is_admin' => array(
					'type' => 'tinyint',
					'constraint' => '1',
					'unsigned' => true,
					'null' => false, 
					'default' => 0
				),
				'is_confirmed' => array(
					'type' => 'tinyint',
					'constraint' => '1',
					'unsigned' => true,
					'null' => false, 
					'default' => 0
				),
				'is_deleted' => array(
					'type' => 'tinyint',
					'constraint' => '1',
					'unsigned' => true,
					'null' => false, 
					'default' => 0
				)
			)
		);

		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('users');

	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}

}


