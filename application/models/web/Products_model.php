<?php
include_once APPPATH . "models/DBHelper.php";
include_once APPPATH . "models/helper_methods/Common.php";
include_once APPPATH . "models/helper_methods/Products.php";
class Products_model extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->response = new Response_helper();
        $this->common = new Common();
        $this->products = new Products();
    }

    public function add_product($images, $pid = FALSE)
    {
        // var_dump($images);
        // $per = $this->input->post('per');
        $oldImg = '';
        if($pid){
          $product = $this->get_product($pid);
          if($product[0]['images']){
            $oldImg = $product[0]['images'];
          }
        }
        $data['product_name'] = str_replace("-"," ",$this->input->post('product_name'));
        $data['price'] = $this->input->post('price');
        $data['dicount_price'] = $this->input->post('dicount_price');
        $data['category_id'] = $this->input->post('category_id');
        $data['speciality_id'] = $this->input->post('speciality_id');
        $data['features'] = implode('|', $this->input->post('features'));
        // if($images[0][0]["file"]["data"]["file_name"]){
        //     $data['images'] = $images[0][0]["file"]["data"]["file_name"];
        // }
        if($images[0] && $oldImg){
            $data['images'] = $oldImg.'|'.implode('|', $images[0]);
        }elseif($images[0]){
            $data['images'] = implode('|', $images[0]);
        }else{
            $data['images'] = $oldImg;
        }
        // $data['images'] = $oldImg.implode('|', $images[0]);
        $data['description'] = $this->input->post('product_description');
        $data['summary'] = $this->input->post('product_summary');
        if($this->input->post('status')){
            $data['status'] = 'y';
        }else{
            $data['status'] = 'n';
        }
        // $data['status'] = $this->input->post('status');

        if (!$data['category_id']) {
            return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Please select Category Name.", array());
        }
        // if (count($per) == 0) {
            // return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Please add atleast 1 varient.", array());
        // }
        if ($pid) {
            $this->update(TABLE_PRODUCTS, $data, array('id' => $pid));
            // $this->add_varients($pid, $images);
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Product has been Updated.", array());
        }
        $insert_id = $this->insert(TABLE_PRODUCTS, $data);
        if ($insert_id) {
            // $this->add_varients($insert_id, $images);
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Product has been Added.", array());
        }
        return $this->response->interal_error();
    }

    public function get_products()
    {
        $data_tables = $this->common->datatables_config();
        $order_by = TABLE_PRODUCTS . ".id ASC";
        if ($data_tables['order']) {
            $column = $data_tables['order'][0]['column'];
            $order_dir = $data_tables['order'][0]['dir'];
        }
        $where = false;
        $select = TABLE_PRODUCTS . ".*, " . TABLE_CATEGORIES . ".name";
        if ($data_tables['search']) {
            $search = $data_tables['search'];
            $where = "(product_name LIKE '%$search%' OR name LIKE '%$search%')";
        }
        if ($data_tables['order']) {
            if ($column > 0) {
                // $order_by = $this->get_order_by($column, $order_dir);
            }
        }

        $result = array();
        $total_products = $this->products->count_products($where);
        $products = $this->products->get_products($select, $where, $order_by, $data_tables['limit'], $data_tables['offset']);
        foreach ($products as $product) {
            $tmp = array();
            // $images = $product['images'];
            // $images = explode('|', $images);
            // $product_image = base_url('assets/uploads/products/small/') . $images[0];
            $tmp[] = "<input type='checkbox' class='products' value='" . $product['id'] . "' name='pid[]' />";
            // $tmp[] = "<img src='$product_image' width='50' height='50' alt='image' />";
            $tmp[] = $product['id'];
            $tmp[] = $product['product_name'];
            $tmp[] = $product['name'];
            $tmp[] = $product['price'];
            $tmp[] = $product['dicount_price'];
            $tmp[] = 100 * ($product['price'] - $product['dicount_price']) / $product['price'];
            $tmp[] = ($product['status'] == 'y' ? 'Enabled' : 'Disabled');
            $edit_btn = "<a href='" . base_url('web/catalog/edit_product/') . $product['id'] . "'><button class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'><i class='fas fa-edit'></i></button></a>";
            $tmp[] = "$edit_btn";
            array_push($result, $tmp);
        }
        $response = array();
        $response['draw'] = $data_tables['draw']++;
        $response['recordsTotal'] = count($result);
        $response['recordsFiltered'] = $total_products;
        $response['data'] = $result;
        return $response;
    }

    public function add_varients($pid, $images = FALSE)
    {
        $per = $this->input->post('per');
        $unit = $this->input->post('unit');
        $mrp = $this->input->post('mrp');
        $selling_price = $this->input->post('selling_price');
        $stocks = $this->input->post('stocks');
        $batch = array();
        // if (count($per) > 0) {
            $varients = $this->select("images, per, unit", TABLE_PRODUCTS_ADDITIONAL, array('product_id' => $pid));
            $this->delete(TABLE_PRODUCTS_ADDITIONAL, array('product_id' => $pid));
            for ($i = 0; $i < count($per); $i++) {
                $tmp = array();
                $tmp['product_id'] = $pid;
                $tmp['per'] = $per[$i];
                $tmp['images'] = $this->get_stored_images($varients, $per[$i], $unit[$i]);
                if ($images) {
                    $is_images_uploaded = $this->check_images_uploaded($per[$i], $images);
                    if ($is_images_uploaded) {
                        $tmp['images'] = $this->get_images_names($per[$i], $images);
                    }
                }
                $tmp['unit'] = $unit[$i];
                $tmp['mrp'] = $mrp[$i];
                $tmp['selling_price'] = $selling_price[$i];
                $tmp['stocks'] = $stocks[$i];
                array_push($batch, $tmp);
            }
        // }
        if ($this->db->insert_batch(TABLE_PRODUCTS_ADDITIONAL, $batch)) {
            return true;
        }
        return false;
    }

    private function get_stored_images($varients, $per, $unit)
    {
        $images = "";
        foreach ($varients as $varient) {
            $db_per = $varient['per'];
            $db_unit = $varient['unit'];
            if ($db_per == $per && $db_unit == $unit) {
                $images = $varient['images'];
                break;
            }
        }
        return $images;
    }

    private function check_images_uploaded($tag, $images)
    {
        $is_uploaded = false;
        foreach ($images as $img) {
            foreach ($img as $item) {
                if ($tag == $item['tag']) {
                    $is_uploaded = true;
                    break;
                }
            }
        }
        return $is_uploaded;
    }
    private function get_images_names($tag, $images)
    {
        $image_names = array();
        foreach ($images as $img) {
            foreach ($img as $item) {
                if ($tag == $item['tag']) {
                    array_push($image_names, $item['file']);
                }
            }
        }
        return implode("|", $image_names);
    }
    public function delete_products()
    {
        $ids = $this->input->post('ids');
        $ids = explode(",", $ids);
        foreach ($ids as $id) {
            // Delete product with images
            $this->products->delete_product($id);
        }
        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Products has been Removed.", array());
    }

    public function get_product($pid)
    {
        return $this->select("*", TABLE_PRODUCTS, array('id' => $pid), false, 1);
    }

    public function get_product_with_where($where)
    {
        return $this->select("*", TABLE_PRODUCTS, $where, false, 1);
    }

    public function get_product_varients($pid)
    {
        return $this->select("*", TABLE_PRODUCTS_ADDITIONAL, array('product_id' => $pid));
    }
}
