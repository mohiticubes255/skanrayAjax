<?php

class Products extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
    }



    public function get_product_by_category ($where, $limit, $offset, $order_by){
        $result = array();
        $this->db
                ->select("*")
                ->from(TABLE_PRODUCTS)
                ->where($where)
                ->limit($limit)
                ->offset($offset)
                ->order_by($order_by);
        $query = $this->db->get()->result_array();
        log_message('error', $this->last_query());
        foreach($query as $product){
            $tmp = $product;
            $tmp['base_url'] = base_url('assets/uploads/products/');
            $tmp['varients'] = $this->get_varients($product['id']);
            array_push($result, $tmp);
        }
        return $result;
    }

    public function get_varients($product_id, $varient_id = FALSE)
    {
        $where['product_id'] = $product_id;
        if($varient_id){
            $where['id'] = $varient_id;
        }
        return $this->select("*", TABLE_PRODUCTS_ADDITIONAL, $where);
    }

    public function get_products($select, $where, $order_by, $limit, $offset)
    {
        $this->db
            ->select($select)
            ->from(TABLE_PRODUCTS)
            ->join(TABLE_CATEGORIES, TABLE_PRODUCTS . ".category_id=" . TABLE_CATEGORIES . ".id", 'left');
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by($order_by)
            ->limit($limit)->offset($offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_products($where)
    {
        $this->db
            ->select("COUNT(*) as numrows")
            ->from(TABLE_PRODUCTS)
            ->join(TABLE_CATEGORIES, TABLE_PRODUCTS . ".category_id=" . TABLE_CATEGORIES . ".id", 'left');
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get()->result_array();
        return $query[0]['numrows'];
    }

    public function delete_product($pid)
    {
        $product_info = $this->select("*", TABLE_PRODUCTS, array('id' => $pid), false, 1);
        if ($product_info) {
            $images_arr = explode('|', $product_info[0]['images']);
            $this->remove_images($images_arr);
            $this->delete(TABLE_PRODUCTS, array('id' => $pid));
            $this->delete(TABLE_PRODUCTS_ADDITIONAL, array('product_id' => $pid));
        }
    }

    private function remove_images($images_arr)
    {
        $folder_path = FCPATH . "uploads/products";

        foreach ($images_arr as $image) {
            if ($image) {
                $lg_image = "$folder_path/large/$image";
                $md_image = "$folder_path/medium/$image";
                $sm_image = "$folder_path/small/$image";
                if (file_exists($lg_image)) {
                    unlink($lg_image);
                }

                if (file_exists($md_image)) {
                    unlink($md_image);
                }

                if (file_exists($sm_image)) {
                    unlink($sm_image);
                }
            }
        }
    }
}
