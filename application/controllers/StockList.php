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
        $this->load->model('stock_list_model');
        print_r($this->stock_list_model->get_all());
    }

    /**
     * Shows full stock list view with entries grouped by category
     */
    public function get()
    {

        check_role('confirmed');

        $this->load->model('facility_model');
        $facility = $this->facility_model->get_facility_by_user_id($_SESSION['user_id']);
        $id = $facility->facility_id;

        $this->load->model('stock_list_model');
        $this->load->model('stock_list_entry_model');
        $this->load->model('category_model');

        $categories = $this->category_model->get_all();

        $this->load->helper('form');
        $demands = $this->input->post('demand');
        $comments = $this->input->post('comment');
        $counts = $this->input->post('count');
        $entries = array();

        if($this->input->post()){
            foreach ($demands as $category_id => $demand) {

                if($demand != 1 && $demand != -1) $demand = 0;

                $entry['StockList'] = $id;
                $entry['Category'] = $category_id;
                $entry['name'] = $categories[$category_id]->name;
                $entry['demand'] = $demand;
                $entry['comment'] = $comments[$category_id];
                $entry['count'] = $counts[$category_id];
                $entries[] = $entry;
            }

            $this->stock_list_entry_model->update($id, $entries);

        }

        $stocklist = $this->stock_list_model->get_grouped_entries($id,$this->category_model->get_tree());

        $this->load->view('header');
        $this->load->view('local_view', array('stocklist' => $stocklist, 'facility' => $facility));
        $this->load->view('footer');
        
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