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

        $facilities = array(
            array(
                'name' => 'Organisation 1',
                'url' => 'www.google.de',
                'address' => 'Tucholskystr. 13, 10967 Berlin',
                'lat' => 52.5196530,
                'lon' => 13.3728780,
            ),
            array(
                'name' => 'Organisaiton 2',
                'url' => 'www.facebook.de',
                'address' => 'Alexanderplatz, Berlin',
                'lat' => 52.493830,
                'lon' => 13.423123,
            ),
            array(
                'name' => 'Organisation 3',
                'url' => 'www.youtube.de',
                'address' => 'Hauptbahnhof, Berlin',
                'lat' => 52.4938300,
                'lon' => 13.999945,
            ),
        );

		$this->load->view('header');
		$this->load->view('facility', array('facilities' => $facilities));
		$this->load->view('footer');
	}


}
