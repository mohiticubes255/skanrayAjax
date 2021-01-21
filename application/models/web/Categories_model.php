<?php
include_once APPPATH . "models/DBHelper.php";
include_once APPPATH . "models/helper_methods/Common.php";
include_once APPPATH . "models/helper_methods/Categories.php";
class Categories_model extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->category = new Categories();
        $this->common = new Common();
        $this->response  = new Response_helper();
    }

    public function get_categories()
    {
        $parent_categories = $this->select('*', TABLE_CATEGORIES, array('parent_id' => 0));
        $data = array();
        $this->category->get_nested_category($parent_categories, $data);
        return $data;
    }

    public function get_parents()
    {
        return $this->select('*', TABLE_CATEGORIES, array('parent_id' => 0));
    }
    public function get_category($category_id)
    {
        return $this->select("*", TABLE_CATEGORIES, array('id' => $category_id), false, 1);
    }
    public function save_category($icon, $cat_id = FALSE)
    {
        $name = $this->input->post('category_name');
        $order = $this->input->post('sort_order');
        $parent_id = $this->input->post('parent');
        $data['name'] = $name;
        if ($parent_id) {
            $data['parent_id'] = $parent_id;
        } else {
            $data['parent_id'] = 0;
        }
        $data['sort_order'] = $order;
        $data['add_date'] = date("Y-m-d H:i:s");

        return $this->category->save_category($data, $icon, $cat_id);
    }

    public function remove_categories()
    {
        $ids = $this->input->post('ids');
        $ids = explode(",", $ids);
        if ($ids) {
            foreach ($ids as $id) {
                $this->delete(TABLE_CATEGORIES, array('id'=>$id));
            }
        }
        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Categories has been Removed.", array());
    }
}
