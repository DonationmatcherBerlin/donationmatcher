<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Public extends CI_Migration
{
	public function up()
	{

		$this->dbforge->add_column('facility',
			array(
				'public_givenow' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'default' => 0,
				),
				'public_internal' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'default' => 0,
				)
			)
		);

	}

	public function down()
	{
		// nobody cares...
	}

}