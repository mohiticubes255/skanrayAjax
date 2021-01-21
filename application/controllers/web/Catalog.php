<?php
include_once APPPATH . 'controllers/BaseController.php';
include_once APPPATH . 'libraries/Response_helper.php';
class Catalog extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('web/categories_model');
        $this->load->model('web/products_model');
        $this->load->model('web/specialities_model');
        $this->response = new Response_helper();
        $this->category = $this->categories_model;
        $this->products = $this->products_model;
        $this->specialities = $this->specialities_model;
    }

    public function index()
    {
        
    }

    public function categories()
    {
        if ($_POST) {
            header('Content-Type: application/json');
            $result = $this->response->invalid_request();
            $action = $this->input->post('action');
            switch ($action) {
                case "remove_category":
                    $result = $this->category->remove_categories();
                    break;
                case "add_category":
                    $icon = "";
                    if ($_FILES) {
                        $icon = $this->upload(100, 100);
                    }
                    $result = $this->category->save_category($icon);
                    break;
            }
            echo json_encode($result);
            die();
        }
        $data['lists']  = $this->category->get_categories();
        $data['parents']  = $this->category->get_parents();
        $this->load->view('admin/catalog/categories/category_list', $data);
    }
    public function specialities()
    {
        if ($_POST) {
            header('Content-Type: application/json');
            $result = $this->response->invalid_request();
            $action = $this->input->post('action');
            switch ($action) {
                case "remove_speciality":
                    $result = $this->specialities->remove_speciality();
                    break;
                case "add_speciality":
                    $result = $this->specialities->save_speciality();
                    break;
            }
            echo json_encode($result);
            die();
        }
        $data['specialities']  = $this->specialities->get_specialities();
        $this->load->view('admin/catalog/specialities/specialities_list', $data);
    }
    public function edit_single_speciality()
    {
        $speciality_id = $this->input->post('speciality_id');
        $speciality = $this->specialities->get_speciality($speciality_id);
        if($speciality){
            echo json_encode(array('status'=>true,'speciality'=>$speciality));
        }else{
            echo json_encode(array('status'=>false));
        }
    }
    public function edit_speciality($speciality_id = FALSE)
    {
        $speciality_id = $this->input->post('speciality_id');
        if ($speciality_id) {
            if ($_POST) {
                header('Content-Type: application/json');
                $result = $this->response->invalid_request();
                $action = $this->input->post('action');
                switch ($action) {
                    case "update_speciality":
                        $result = $this->specialities->save_speciality($speciality_id);
                        break;
                }
                echo json_encode($result);
                die();
            }
            
        }
    }
    public function edit_category($category_id = FALSE)
    {
        $category_id = $this->input->post('category_id');
        if ($category_id) {
            if ($_POST) {
                header('Content-Type: application/json');
                $result = $this->response->invalid_request();
                $action = $this->input->post('action');
                switch ($action) {
                    case "update_category":
                        $icon = "";
                        if ($_FILES) {
                            $icon = $this->upload(100, 100);
                        }
                        $result = $this->category->save_category($icon, $category_id);
                        break;
                }
                echo json_encode($result);
                die();
            }
            $data['category'] = $this->category->get_category($category_id);
            $data['parents'] = $this->category->get_categories();
            $this->load->view('web/catalog/categories/edit_category', $data);
        }
    }
    public function edit_single_category()
    {
        $category_id = $this->input->post('category_id');
        $category = $this->category->get_category($category_id);
        if($category){
            $opt = '<option value="" selected disabled>Select Category</option>';
            $parents = $this->category->get_parents();
            foreach ($parents as $parent) {
                if($parent['id'] == $category[0]['parent_id']){
                    $optSelect = 'selected';
                }else{
                    $optSelect = '';
                }
                $opt .= '<option value="'.$parent['id'].'" '.$optSelect.'>'.$parent['name'].'</option>';
            }
            echo json_encode(array('status'=>true,'category'=>$category,'opt'=>$opt));
        }else{
            echo json_encode(array('status'=>false));
        }
    }

    public function products()
    {
        if ($_POST) {
            header('Content-Type: application/json');
            $result = $this->response->invalid_request();
            $action = $this->input->post('action');
            switch ($action) {
                case "get_products":
                    $result = $this->products->get_products();
                    break;

                    case "remove_products":
                        $result = $this->products->delete_products();
                    break;
            }
            echo json_encode($result);
            die();
        }
        $data['lists']  = $this->products->get_products();
        $this->load->view('admin/catalog/products/products',$data);
    }

    public function edit_product($pid = FALSE)
    {
        if ($_POST) {
            $pid = $this->input->post('id');
            header('Content-Type: application/json');
            // $result = $this->response->invalid_request();
            $action = $this->input->post('action');
            switch ($action) {
                case "update_product":
                    $all_images = array();
                    if ($_FILES) {
                        $images = $this->upload_multiple_images();
                        array_push($all_images, $images);
                    }
                    $result = $this->products->add_product($all_images, $pid);
                    break;
            }
            echo json_encode($result);
            die();
        }
        $data['parents'] = $this->category->get_categories();
        $data['categories'] = $this->category->get_categories();
        $data['product'] = $this->products->get_product($pid);
        $data['varients'] = $this->products->get_product_varients($pid);
        $this->load->view('admin/catalog/products/edit_product', $data);
    }

    public function add_product()
    {
        if ($_POST) {
            header('Content-Type: application/json');
            $result = $this->response->invalid_request();
            $action = $this->input->post('action');
            switch ($action) {
                case "add_product":
                    $all_images = array();
                    if ($_FILES) {
                        // $images = $this->get_uploaded_products();
                        $images = $this->upload_multiple_images();
                        array_push($all_images, $images);
                    }
                    $result = $this->products->add_product($all_images);
                    break;
            }
            echo json_encode($result);
            die();
        }
        $data['categories'] = $this->category->get_categories();
        $data['specialities'] = $this->specialities->get_specialities();
        $this->load->view('admin/catalog/products/add_product', $data);
    }

    /*
	 * UPLOAD ICONS / PRODUCTS FOR CATEGORY
	 */
    private function get_uploaded_products()
    {
        $this->load->library('image_library');
        $file_names = array();
        if ($_FILES) {
            $files = $_FILES;
            $count = count($_FILES);
            if ($count > 0) {
                foreach($files as $key=>$value){
                    $file_name = $key;
                    $tag = explode("_", $file_name)[0];
                    $file = $this->image_library->upload_products($file_name);
                    if ($file) {
                        $tmp = array();
                        $tmp['file'] = $file;
                        $tmp['tag'] = $tag;
                        array_push($file_names, $tmp);
                    }
                }
            }
        }
        return $file_names;
    }
    private function upload_multiple_images()
    {
        $error=array();
		// $extension=array("jpeg","jpg","png","gif");
		$extension=array("jpeg","jpg","png");
        $file_names = array();
        foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name) {
			$file_name=$_FILES["images"]["name"][$key];
			$file_tmp=$_FILES["images"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			if(in_array($ext,$extension)) {
					$filename=basename($file_name,$ext);
					$newFileName='product-'.uniqid().'.'.$ext;
					if(move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"][$key],"uploads/products/".$newFileName))
					{
                        array_push($file_names,$newFileName);
					}
			}
			else {
				array_push($error,"$file_name, ");
			}
        }
        return $file_names;
    }
}
