<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility extends CI_Controller {

    /**
     * Facility overview
     */
	public function index()
	{
		check_role('confirmed');

		$this->load->model('facility_model');
		print_r($this->facility_model->get_all());

		$this->load->view('header');
		$this->load->view('facility');
		$this->load->view('footer');
	}

}
