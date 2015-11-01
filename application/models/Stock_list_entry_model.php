<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list_entry_model extends CI_Model
{
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
        if (empty($category_ids)) {
            return [];
        }

        $foreign_list = $this->get_demand_list($stock_list_id, 1, array_column($category_ids, 'category_id'));
        return $this->group(
            $this->handle_exact_match($stock_list_id, $foreign_list, 1)
        );
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
        if (empty($category_ids)) {
            return [];
        }

        $foreign_list = $this->get_demand_list($stock_list_id, -1, array_column($category_ids, 'category_id'));

        return $this->group(
            $this->handle_exact_match($stock_list_id, $foreign_list, -1)
        );
    }

    /**
     * Returns all stock list entries of given stock list
     *
     * @param int $stock_list_id
     * @return array
     */
    public function get_by_stock_list($stock_list_id)
    {
        $query = $this->db->query(
            '
              SELECT
                *
              FROM
                stock_list_entry sle
              WHERE
                sle.StockList = ?
            ',
            [
                (int) $stock_list_id,
            ]
        );

        return $query->result_array();
    }

    /**
     * Removes or highlights exact matches
     *
     * @param $stock_list_id
     * @param $foreign_list
     */
    private function handle_exact_match($stock_list_id, $foreign_list, $demand)
    {
        $own_list = $this->get_by_stock_list($stock_list_id);
        foreach ($foreign_list as $i => $foreign_row) {
            foreach ($own_list as $own_row) {
                if ($own_row['name'] == $foreign_row['name']) {
                    switch ((int) $own_row['demand']) {
                        case '0':
                        case $demand:
                            unset($foreign_list[$i]);
                            continue 2;
                            break;
                        case $demand*-1:
                            $foreign_list[$i]['exact'] = true;
                            break;
                    }
                }
            }
        }

        return $foreign_list;
    }

    /**
     * Grouped by facility
     *
     * @param array $list
     * @return array
     */
    private function group(array $list)
    {
        $grouped = [];
        foreach ($list as $entry) {
            $grouped[$entry['facility']][] = $entry;
        }

        return $grouped;
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
                c.category_id AS `category_id`,
                c.name AS category_name,
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

        return $results;
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
      $sql = "insert into stock_list_entry (StockList,Parent,name,demand,created_at) 
              select 
                (select stock_list_id from stock_list where Facility = ".$stock_list_id."),
              Parent, name, 0, '".date("Y-m-d H:i:s")."' from category where Parent is not null";

      $this->db->query($sql);

    }

}