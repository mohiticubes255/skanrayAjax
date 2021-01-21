<?php
include_once APPPATH . "models/DBHelper.php";
class Sales_model extends DBHelper {

    public function __construct() {
        parent::__construct();
    }
    public function get_all_orders()
    {
        return $this->select("*", TABLE_ALL_ORDER, false, 1);
    }
    public function get_order($where)
    {
        return $this->select("*", TABLE_ALL_ORDER, $where, false, 1);
    }
    public function update_order($id,$data)
    {
        return $this->update(TABLE_ALL_ORDER, $data, array('id' => $id));
    }

}