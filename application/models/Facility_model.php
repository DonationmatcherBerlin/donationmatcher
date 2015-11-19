<?php
class Facility_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all()
    {
        $query = $this->db->get('facility');

        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->facility_id] = $row;
        }

        return $result;
    }
	
	
	function get_stock()
    {
        $query = $this->db->get('stock_list_entry');

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