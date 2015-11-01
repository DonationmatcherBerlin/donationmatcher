<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockList extends CI_Controller
{
    /**
     * Lists all stock lists
     */
    public function index()
    {

        check_role('confirmed');

        $this->load->model(array('facility_model', 'category_model', 'stock_list_model', 'stock_list_entry_model'));
        $facility = $this->facility_model->get_facility_by_user_id($_SESSION['user_id']);
        $stocklist = $this->stock_list_model->get_by_facility($facility->facility_id);

        $id = $stocklist->stock_list_id;

        $this->load->helper('form');
        $demands = $this->input->post('demand');
        $comments = $this->input->post('comment');
        $counts = $this->input->post('count');
        $entries = array();

        if($this->input->post()){
            foreach ($demands as $stock_list_entry_id => $demand) {

                if($demand != 1 && $demand != -1) $demand = 0;

                $entry['stock_list_entry_id'] = $stock_list_entry_id;
                $entry['demand'] = $demand;
                $entry['comment'] = $comments[$stock_list_entry_id];
                $entry['count'] = $counts[$stock_list_entry_id];
                $entries[] = $entry;
            }

            $this->stock_list_entry_model->update($entries);

        }

        $stocklist = $this->stock_list_model->get_grouped_entries($id,$this->category_model->get_tree());

        $this->load->view('header');
        $this->load->view('local_view', array('stocklist' => $stocklist, 'facility' => $facility));
        $this->load->view('footer');
    }
}