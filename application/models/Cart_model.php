<?php
include_once APPPATH . "models/DBHelper.php";
class Cart_model extends DBHelper {

    public function __construct() {
        parent::__construct();
    }
    public function add_to_cart($data,$cid = FALSE)
    {
        if ($cid) {
            $this->update(TABLE_ADD_TO_CART, $data, array('id' => $cid));
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Cart has been Updated.", array());
        }
        $insert_id = $this->insert(TABLE_ADD_TO_CART, $data);
        if ($insert_id) {
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Cart has been Added.", array());
        }
    }
    public function get_cart_with_where($where)
    {
        return $this->select("*", TABLE_ADD_TO_CART, $where, false, 1);
    }
    public function get_updated_cart($cid)
    {
        $cart = $this->db->query("select a.*,b.images from add_to_card as a,products as b where b.id=a.product_id and a.cid='".$cid."'")->result_array();
        return $cart;
    }
    public function delete_cart_products($where)
    {
        $delete = $this->delete(TABLE_ADD_TO_CART, $where);
        return $delete;
    }
    public function get_total_booked_products($cid)
    {
        $products = $this->db->query("SELECT count(id) as total_product, SUM(total_amount) as total_amount FROM `add_to_card` WHERE cid='".$cid."'")->result_array();
        return $products;
    }
    public function add_order($data)
    {
        $insert_id = $this->insert(TABLE_ALL_ORDER, $data);
        return $insert_id;
    }
    public function add_order_products($data)
    {
        $insert_id = $this->insert(TABLE_ORDER_PRODUCT, $data);
        return $insert_id;
    }
}