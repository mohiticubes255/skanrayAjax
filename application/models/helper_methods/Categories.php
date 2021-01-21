<?php
include_once APPPATH . "models/DBHelper.php";
class Categories extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_category($data, $icon, $cat_id = FALSE)
    {
        // $parent_id = $data['parent_id'];
        $parent_id = $data['parent_id'] = $this->input->post('parent_id');
        if ($cat_id) {
            // Update Category 
            if ($parent_id == $cat_id) {
                return $this->response->response(STATUS_FAILED, RESPONSE_INTERNAL_ERROR, "Category cannot be parent of Itself.", array());
            }
            if($icon){
                $data['icon'] = $icon;
            }
            $this->update(TABLE_CATEGORIES, $data, array('id'=>$cat_id));
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Category updated Successfully.", array());
        }
        $data['icon'] = $icon;
        if($this->insert(TABLE_CATEGORIES, $data)){
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Category added Successfully.", array());
        }
        return $this->response->internal_error();
    }
    public function get_nested_category($array, &$data)
    {
        foreach ($array as $category) {
            $tmp = array();
            $tmp['cat_id'] = $category['id'];
            $name = array();
            $this->get_parent_name($category['id'], $name); // push parent name in array
            $pname = implode(',', array_reverse($name)); // reverse array and convert to string
            $parent_name = str_replace(',', ' > ', $pname); // remove , with > 
            if ($parent_name != "") {
                $tmp['name'] = $parent_name . " > " . $category['name'];
            } else {
                $tmp['name'] = $category['name'];
            }
            $tmp['sort_order'] = $category['sort_order'];
            $tmp['icon'] = $category['icon'];
            array_push($data, $tmp);
            $sub_category = $this->select("id, name, sort_order, icon", TABLE_CATEGORIES, array('parent_id' => $category['id']));
            if (count($sub_category) > 0) {
                $this->get_nested_category($sub_category, $data);
            }
        }
    }

    public function get_parent_name($cat_id, &$name)
    {
        $parents = $this->select("parent_id", TABLE_CATEGORIES, array('id' => $cat_id), false, 1);
        if (count($parents) > 0) {
            $pid = $parents[0]['parent_id'];
            if ($pid != 0) {
                $parent = $this->get_parent($pid);
                array_push($name, $parent);
                $this->get_parent_name($pid,  $name);
            }
        }
    }

    public function get_parent($pid)
    {
        $parent = $this->select("name", TABLE_CATEGORIES, array('id' => $pid), false, 1);
        if (count($parent) == 1)
            return $parent[0]['name'];
        return "";
    }
}
