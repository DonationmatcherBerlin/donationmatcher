<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockList extends CI_Controller
{
    /**
     * Lists all stock lists
     */
    public function index()
    {
        $this->load->model('stock_list_model');
        print_r($this->stock_list_model->get_all());
    }

    /**
     * Shows full stock list view with entries grouped by category
     */
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

    /**
     * Shows demand
     */
    public function demand($id)
    {
        $this->load->model('stock_list_entry_model');
        echo '<pre>';
        var_dump(
            $this->stock_list_entry_model->get_demand($id)
        );
        echo '</pre>';
    }

    /**
     * Shows offers
     */
    public function offers($id)
    {
        $this->load->model('stock_list_entry_model');
        echo '<pre>';
        var_dump(
            $this->stock_list_entry_model->get_offers($id)
        );
        echo '</pre>';
    }
}