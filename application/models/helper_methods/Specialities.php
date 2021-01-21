<?php

class Specialities extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
    }
    public function save_speciality($data, $s_id = FALSE)
    {
        if ($s_id) {
            // Update Speciality 
            $this->update(TABLE_SPECIALITIES, $data, array('SPECIALITYID'=>$s_id));
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Speciality updated Successfully.", array());
        }
        if($this->insert(TABLE_SPECIALITIES, $data)){
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Speciality added Successfully.", array());
        }
        return $this->response->internal_error();
    }
    public function get_specialities($select, $where, $order_by, $limit, $offset)
    {
        $this->db
            ->select($select)
            ->from(TABLE_SPECIALITIES);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by($order_by)
            ->limit($limit)->offset($offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_specialities($where)
    {
        $this->db
            ->select("COUNT(*) as numrows")
            ->from(TABLE_SPECIALITIES);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get()->result_array();
        return $query[0]['numrows'];
    }




}
