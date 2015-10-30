<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends CI_Controller {

    /**
     * Demand and offers matching list
     */
    public function match()
    {
        check_role('confirmed');

        $this->load->model(array('stock_list_entry_model', 'stock_list_model'));
        $stocklist = $this->stock_list_model->get_by_user($_SESSION['user_id']);

        $demand = $this->stock_list_entry_model->get_demand($stocklist['stock_list_id']);
        $offers = $this->stock_list_entry_model->get_offers($stocklist['stock_list_id']);

        $this->load->view('header');
        $this->load->view('match_view', [
            'demand' => $demand,
            'offers' => $offers
        ]);
        $this->load->view('footer');
    }
}
