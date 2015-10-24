<?php
class Stock_list_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all()
    {
        $query = $this->db->get('stock_list');
        return $query->result();
    }
}