<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockList extends CI_Controller
{
    public function index()
    {
        $this->load->model('stock_list_model');
        print_r($this->stock_list_model->get_all());
    }

    public function get($id)
    {
        $this->load->model('stock_list_model');
        $this->load->model('category_model');

        echo '<pre>';
        var_dump(
            $this->stock_list_model->get_grouped_entries(
                $id,
                $this->category_model->get_tree()
            )
        );
        echo '</pre>';
    }
}