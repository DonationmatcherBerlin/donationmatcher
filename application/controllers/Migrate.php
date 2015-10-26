<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function index(){

		check_role('admin');
		$this->load->library('migration');

		if ( ! $this->migration->latest())
		{
			show_error($this->migration->error_string());
		}

	}

	public function reset()
	{
		check_role('admin');
		$this->load->library('migration');
		
		$this->migration->version(0);

		if ( ! $this->migration->latest())
		{
			show_error($this->migration->error_string());
		}
	}
}
