<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list_model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Returns all stock lists
     *
     * @return array
     */
    public function get_all()
    {
        $query = $this->db->get('stock_list');
        return $query->result_array();
    }

    /**
     * Returns single stock list
     *
     * @param $id
     * @return array
     */
    public function get_one($id)
    {
        $query = $this->db->query(
            'SELECT * FROM stock_list WHERE stock_list_id = ?',
            [(int) $id]
        );

        return $query->result_array();
    }

    /**
     * Returns single stock list
     *
     * @param $facility_id
     * @return array
     */
    public function get_by_facility($facility_id)
    {
        $this->db->where('Facility', $facility_id);
        $row = $this->db->get('stock_list')->row();

        $row->created_at = new \DateTime($row->created_at);
        $row->updated_at = $row->updated_at !== null ? new \DateTime($row->updated_at) : null;

        return $row;
    }

    /**
     * Gets stock list by user
     *
     * @param $user_id
     * @return array
     */
    public function get_by_user($user_id)
    {
        $query = $this->db->query(
            'SELECT sl.*
              FROM stock_list sl
              INNER JOIN facility f ON f.facility_id = sl.Facility
              INNER JOIN users u ON u.id = f.User
              WHERE u.id = ?',
            [(int) $user_id]
        );

        $row = $query->result()[0];
        $row->created_at = new \DateTime($row->created_at);
        $row->updated_at = $row->updated_at !== null ? new \DateTime($row->updated_at) : null;

        return $row;
    }

    /**
     * Returns stock list entries grouped by categories
     *
     * @param int $id
     * @param array $category_tree
     * @return array
     */
    public function get_grouped_entries($id, array $category_tree)
    {
        $query = $this->db->query(
            '
              SELECT *
              FROM stock_list_entry
              WHERE
                StockList = ?
            ',
            [(int) $id]
        );

        $rows = $query->result_array();
        foreach ($rows as &$row) {
            $row['created_at'] = $this->transformDate($row['created_at']);
            $row['updated_at'] = $this->transformDate($row['updated_at']);
        }

        return $this->group_by_category($category_tree, $rows);
    }

    public function get_grouped_demanded_entries($id, array $category_tree)
    {
        $query  =$this->db->query(
            '
                SELECT *
                FROM stock_list_entry
                WHERE StockList = ? AND demand < 0
            ',
            [(int) $id]
        );

        $rows = $query->result_array();
        foreach ($rows as &$row) {
            $row['created_at'] = $this->transformDate($row['created_at']);
            $row['updated_at'] = $this->transformDate($row['updated_at']);
        }

        return $this->group_by_category($category_tree, $rows);
    }

    /**
     * @param array $category_tree
     * @param array $rows
     * @return array
     */
    private function group_by_category(array $category_tree, array $rows)
    {
        // group by category
        $category_rows = [];
        foreach ($rows as $row) {
            $category_rows[$row['Category']][] = $row;
        }

        foreach ($category_tree as &$category) {
            unset($category['Parent']);
            if (isset($category_rows[$category['category_id']])) {
                $category['entries'] = $category_rows[$category['category_id']];
            } else {
                $category['entries'] = [];
            }
            if (isset($category['children'])) {
                // recursion!
                $category['children'] = $this->group_by_category($category['children'], $rows);
            } else {
                $category['children'] = [];
            }
        }

        return $category_tree;
    }

    /**
     * @param string $created_at
     * @return DateTime|null
     */
    private function transformDate($created_at)
    {
        if ($created_at !== null) {
            $created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $created_at);
        }

        return $created_at;
    }

    public function createStockList($facility_id){
        $sql = "insert into stock_list (Facility,created_at) values (?, ?);";
        $this->db->query($sql, [
            (int) $facility_id,
            date("Y-m-d H:i:s")
        ]);

        return $this->db->insert_id();
    }
}