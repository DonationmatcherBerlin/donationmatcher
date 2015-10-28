<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends CI_Controller {

    /**
     * Demand and offers matching list
     */
    public function match()
    {
        check_role('confirmed');
        $this->load->view('header');
        $this->load->view('match_view');
        $this->load->view('footer');
    }

    /**
     * Shows demand
     */
    public function demand($stock_list_id)
    {
        check_role('confirmed');
        $this->load->model('stock_list_entry_model');
        echo '<pre>';
        var_dump(
            $this->stock_list_entry_model->get_demand($stock_list_id)
        );
        echo '</pre>';
    }

    /**
     * Shows offers
     */
    public function offers($stock_list_id)
    {
        check_role('confirmed');
        $this->load->model('stock_list_entry_model');
        echo '<pre>';
        var_dump(
            $this->stock_list_entry_model->get_offers($stock_list_id)
        );
        echo '</pre>';
    }
}
