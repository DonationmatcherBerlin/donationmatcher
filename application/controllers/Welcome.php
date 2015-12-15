<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * start page
     */
	public function index()
	{
		$this->load->view('welcome');
	}

    /**
     * top demand page
     */
    public function top()
    {
        //$this->load->view('under_construction_view');
        //return;

        $this->load->helper('opening_hours');
        $this->load->model(array('stock_list_entry_model', 'facility_model'));

        $top_demand = $this->stock_list_entry_model->get_top_demand(10);
        $top_facilities = $this->facility_model->get_by_top_demand();
        $all_facilities = $this->facility_model->get_all();

        $this->load->view('header');
        $this->load->view('top_demand', array(
            'top_demand' => $top_demand,
            'facilities' => $top_facilities,
        ));
        $this->load->view('all_facilities', array(
            'facilities' => $all_facilities,
        ));

        $this->load->view('footer');
    }

}
