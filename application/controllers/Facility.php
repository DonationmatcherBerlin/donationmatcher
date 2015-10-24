<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility extends CI_Controller {

	public function index()
	{
		$this->load->model('facility_model');
		print_r($this->facility_model->get_all());

	}

}
