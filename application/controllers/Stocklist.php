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
            redirect('/stocklist');
        }

        $entries = $this->stock_list_model->get_grouped_entries($id,$this->category_model->get_tree());

        $this->load->view('header');
        $this->load->view('local_view', array(
            'stocklist' => $stocklist,
            'entries' => $entries,
            'facility' => $facility
        ));
        $this->load->view('footer');
    }


    public function pdf($facility_id)
    {
        check_role('confirmed');

        $this->load->model(array('facility_model', 'stock_list_model', 'category_model'));
        $this->load->library('pdf');
        $this->load->helper('opening_hours');


        $facility = $this->facility_model->get_facility($facility_id);
        $stock_list = $this->stock_list_model->get_by_facility($facility_id);
        $grouped_stock_list = $this->stock_list_model->get_grouped_entries($stock_list->stock_list_id,$this->category_model->get_tree());

        $clean_facility_name = preg_replace('/[^\da-z]/i', '_', $facility->name);
        $pdf_name = 'bedarfsliste-' . date('Ymd_Hi') . '-' . strtolower($clean_facility_name) . '.pdf';

        $this->pdf->load_view('stocklist/pdf/internal', array(
            'facility' => $facility,
            'stock_list' => $stock_list,
            'grouped_stock_list' => $grouped_stock_list,
            'demand_label' => array(
                '-1' => 'Bedarf',
                '0' => 'OK',
                '1' => 'Überschuss',
            ),
        ));
        $this->pdf->set_paper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream($pdf_name);
    }

    public function public_pdf($facility_id)
    {
        $this->load->model(array('facility_model', 'stock_list_model', 'category_model'));
        $this->load->library('pdf');
        $this->load->helper('opening_hours');

        $facility = $this->facility_model->get_facility($facility_id);
        $stock_list = $this->stock_list_model->get_by_facility($facility_id);
        $grouped_stock_list = $this->stock_list_model->get_grouped_demanded_entries($stock_list->stock_list_id,$this->category_model->get_tree());

        $clean_facility_name = preg_replace('/[^\da-z]/i', '_', $facility->name);
        $pdf_name = 'bedarfsliste-fuer-spender-' . date('Ymd_Hi') . '-' . strtolower($clean_facility_name) . '.pdf';

        $this->pdf->load_view('stocklist/pdf/public', array(
            'facility' => $facility,
            'stock_list' => $stock_list,
            'grouped_stock_list' => $grouped_stock_list,
            'demand_label' => array(
                '-1' => 'Bedarf',
                '0' => 'OK',
                '1' => 'Überschuss',
            ),
        ));
        $this->pdf->set_paper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream($pdf_name);
    }

}