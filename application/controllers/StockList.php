<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockList extends CI_Controller
{
    public function index()
    {
        $this->load->model('stock_list_model');
        print_r($this->stock_list_model->get_all());
    }
}