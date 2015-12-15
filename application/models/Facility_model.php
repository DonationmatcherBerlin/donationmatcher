<?php
class Facility_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all()
    {
        $this->db->where('public_flag',1);
        $query = $this->db->get('facility');

        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->facility_id] = $row;
        }

        return $result;
    }

    public function get_facility($facility_id)
    {
        $this->db->from('facility');
        $this->db->where('facility_id', $facility_id);
        return $this->db->get()->row();
    }


    public function get_facility_by_user_id($user_id)
    {
        $this->db->where('User', $user_id);
        $query = $this->db->get('facility');
        return $query->row();
    }

    public function get_by_top_demand()
    {
        $query = $this->db->query('
            SELECT
              f.*,
              SUM(sle.demand) AS demand
            FROM facility f
              INNER JOIN stock_list sl ON sl.Facility = f.facility_id
              INNER JOIN stock_list_entry sle ON sle.StockList = sl.stock_list_id
            WHERE
              sle.demand = 1
              AND f.public_givenow = 1
            GROUP BY f.facility_id
            ORDER BY demand DESC
        ');

        return $query->result_array();
    }

    /**
     * create_facility function.
     * 
     * @access public
     * @param array $data
     * @return bool true on success, false on failure
     */
    public function create_facility($data) {

        $data->created_at = date('Y-m-d H:i:s');
        return $this->db->insert('facility', $data);
        
    }

    /**
     * update_facility function.
     * 
     * @access public
     * @param array $data
     * @return bool true on success, false on failure
     */
    public function update_facility($data) {

        $data->updated_at = date('Y-m-d H:i:s');
        $this->db->where('facility_id', $data->facility_id);
        unset($data->facility_id);
        return $this->db->update('facility', $data);
        
    }
}