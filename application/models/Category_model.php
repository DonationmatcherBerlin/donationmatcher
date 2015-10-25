<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Returns nested category tree
     *
     * @return array
     */
    public function get_tree() {
        $categories = $this->db->get('category')->result_array();
        $nested = [];

        foreach ($categories as &$s) {
            if ($s['Parent'] === null) {
                $nested[] = &$s;
            } else {
                $pid = $s['Parent'];
                if (isset($categories[$pid])) {
                    if (!isset($categories[$pid]['children'])) {
                        $categories[$pid]['children'] = [];
                    }
                    $categories[$pid]['children'][] = &$s;
                }
            }
        }

        return $nested;
    }

    public function get_all(){
        $categories = $this->db->get('category')->result();
        foreach ($categories as $category) {
            $result[$category->category_id] = $category;
        }
        return $result;
    }

}