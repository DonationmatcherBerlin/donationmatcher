<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_BusinessHoursField extends CI_Migration
{
	public function up()
	{

		$db = $this->load->database('default',true);
		$this->dbforge->modify_column('facility',
			array(
				'opening_hours' => array(
					'type' => 'TEXT',
					'default' => '',
				)
			)
		);
		$db->query('update facility set opening_hours = \'[{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null},{"isActive":false,"timeFrom":null,"timeTill":null}]\';');

	}

	public function down()
	{
		// nobody cares...
	}

}