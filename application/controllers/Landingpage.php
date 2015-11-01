<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {

    /**
     * Temporary "under construction" page
     */
    public function index()
    {
        $this->load->view('header');
        $this->load->view('landingpage');
        $this->load->view('footer');
    }
}
