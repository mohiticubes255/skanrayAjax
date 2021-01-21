<?php

class Shop_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_categories() {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    public function get_specialities() {
        $this->db->order_by('speciality_name', 'asc');
        $this->db->where('speciality_status','y');
        $query = $this->db->get('specialities');
        return $query->result_array();
    }
    function get_max_price()
    {
        $this->db->select_max('dicount_price');
        $query = $this->db->get('products');
        $max_price = $query->row_array();
        return $max_price;
    }
    function get_min_price()
    {
        $this->db->select_min('dicount_price');
        $query = $this->db->get('products');
        $min_price = $query->row_array();
        return $min_price;
    }
    function make_query($categories, $specialities, $minimum_price, $maximum_price)
    {
        $query = "
        SELECT * FROM `products` WHERE `status` = 'y'
        ";

        if(isset($categories))
        {
            $categories_filter = implode("','", $categories);
            $query .= "
                AND category_id IN('".$categories_filter."')
            ";
        }

        if(isset($specialities))
        {
            $specialities_filter = implode("','", $specialities);
            $query .= "
                AND speciality_id IN('".$specialities_filter."')
            ";
        }
        
        if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
        {
            $query .= "
                AND dicount_price BETWEEN '".$minimum_price."' AND '".$maximum_price."'
            ";
        }
        return $query;
    }

    function get_count($categories, $specialities, $minimum_price, $maximum_price)
    {
        $query = $this->make_query($categories, $specialities, $minimum_price, $maximum_price);
        $data = $this->db->query($query);
        return $data->num_rows();
    }

    public function get_products($limit, $start, $categories, $specialities, $minimum_price, $maximum_price) {
        $query = $this->make_query($categories, $specialities, $minimum_price, $maximum_price);
        $query .= ' LIMIT '.$start.', ' . $limit;
        $data =  $this->db->query($query);
        return $data->result();
    }
    
    
}