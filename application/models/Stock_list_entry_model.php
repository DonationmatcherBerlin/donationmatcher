<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list_entry_model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_demand($id)
    {
        // get all categories of entries with negative demand from own stock list
        $query = $this->db->query(
            '
              SELECT
                c.category_id
              FROM stock_list_entry sle
                INNER JOIN category c ON sle.Category = c.category_id
              WHERE
                sle.StockList = ?
                AND sle.demand = -1
              GROUP BY
                c.category_id
            ',
            [(int) $id]
        );
        $category_ids = $query->result_array();

        // get facilities with positive demand in those categories
        $query = $this->db->query(
            '
              SELECT
                sle.name AS sle_name,
                f.name AS f_name
              FROM stock_list_entry sle
                INNER JOIN stock_list sl ON sl.stock_list_id = sle.StockList
                INNER JOIN facility f ON f.facility_id = sl.Facility
              WHERE
                sle.StockList != ?
                AND sle.demand = 1
                AND sle.Category IN (?)
            ',
            [
                (int) $id,
                implode(',', array_column($category_ids, 'category_id'))
            ]
        );

        return $query->result_array();
    }
}