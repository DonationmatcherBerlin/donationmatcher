<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list_entry_model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Returns stock list entries of other stock lists that offers stuff you need
     *
     * @param $stock_list_id
     * @return array
     */
    public function get_demand($stock_list_id)
    {
        $category_ids = $this->get_categories($stock_list_id, -1);
        return $this->get_demand_list($stock_list_id, 1, array_column($category_ids, 'category_id'));
    }

    /**
     * Returns stock list entries of other stock lists that demand stuff you have
     *
     * @param $stock_list_id
     * @return array
     */
    public function get_offers($stock_list_id)
    {
        $category_ids = $this->get_categories($stock_list_id, 1);
        return $this->get_demand_list($stock_list_id, -1, array_column($category_ids, 'category_id'));
    }

    /**
     * Get all categories of entries with negative demand from own stock list
     */
    private function get_categories($stock_list_id, $demand)
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
                (int) $stock_list_id,
                (int) $demand
            ]
        );

        return $query->result_array();
    }

    /**
     * Get facilities with positive demand in those categories
     */
    private function get_demand_list($stock_list_id, $demand, array $category_ids)
    {
        $query = $this->db->query(
            '
              SELECT
                sle.name AS `name`,
                c.name AS category,
                CONCAT(f.name, " / ", CONCAT_WS(" ", f.address, f.zip, f.city)) AS facility
              FROM stock_list_entry sle
                INNER JOIN stock_list sl ON sl.stock_list_id = sle.StockList
                INNER JOIN facility f ON f.facility_id = sl.Facility
                INNER JOIN category c ON sle.Category = c.category_id
              WHERE
                sle.StockList != ?
                AND sle.demand = ?
                AND sle.Category IN ('.implode(',', $category_ids).')
            ',
            [
                (int) $stock_list_id,
                (int) $demand
            ]
        );
        $results = $query->result_array();

        $grouped = [];
        foreach ($results as $entry) {
            $grouped[$entry['facility']][$entry['category']][] = $entry['name'];
        }

        return $grouped;
    }

    /**
     * BUlk updates stock list entries
     *
     * @param array $entries
     */
    public function update(array $entries){
        $this->db->update_batch('stock_list_entry', $entries, 'stock_list_entry_id');
    }

    public function insert_empty_stocklist_entries($stock_list_id){
      $sql = "insert into stock_list_entry (StockList,Category,name,demand,created_at) 
              select 
                (select stock_list_id from stock_list where Facility = ".$stock_list_id."),
              category_id, name, 0, '".date("Y-m-d H:i:s")."' from category";

      $this->db->query($sql);
    }

}