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
        $category_ids = $this->get_categories($id, -1);
        return $this->get_demand_list($id, 1, array_column($category_ids, 'category_id'));
    }

    public function get_offers($id)
    {
        $category_ids = $this->get_categories($id, 1);
        return $this->get_demand_list($id, -1, array_column($category_ids, 'category_id'));
    }

    /**
     * Get all categories of entries with negative demand from own stock list
     */
    private function get_categories($id, $demand)
    {
        $query = $this->db->query(
            '
              SELECT
                c.category_id
              FROM stock_list_entry sle
                INNER JOIN category c ON sle.Category = c.category_id
              WHERE
                sle.StockList = ?
                AND sle.demand = ?
              GROUP BY
                c.category_id
            ',
            [
                (int) $id,
                (int) $demand
            ]
        );

        return $query->result_array();
    }

    /**
     * Get facilities with positive demand in those categories
     */
    private function get_demand_list($id, $demand, array $category_ids)
    {
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
                AND sle.demand = ?
                AND sle.Category IN (?)
            ',
            [
                (int) $id,
                (int) $demand,
                implode(',', $category_ids)
            ]
        );

        return $query->result_array();
    }

    
    public function update($stocklist, $entries){

        $this->db->trans_start();
        $this->db->where('StockList', $stocklist);
        $this->db->delete('stock_list_entry');
        $this->db->insert_batch('stock_list_entry', $entries);
        $this->db->trans_complete();

    }
}