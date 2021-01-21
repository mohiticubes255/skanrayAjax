<?php
include_once APPPATH . 'controllers/BaseController.php';
include_once APPPATH . 'libraries/Response_helper.php';
class Sales extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('web/categories_model');
        $this->load->model('web/products_model');
        $this->load->model('web/specialities_model');
        $this->load->model('web/sales_model');
        $this->response = new Response_helper();
        $this->category = $this->categories_model;
        $this->products = $this->products_model;
        $this->specialities = $this->specialities_model;
        $this->sales = $this->sales_model;
    }

    public function index()
    {
        
    }
    public function orders()
    {
        $data['orders']  = $this->sales->get_all_orders();
        $this->load->view('admin/sales/orders',$data);
    }
    public function get_order()
    {
        $id = $this->input->post('order_id');
        $order  = $this->sales->get_order(array('id'=>$id));
        echo json_encode($order[0]);
    }
    public function edit_order()
    {
        $id = $this->input->post('order_id');
        $data = array('payment_status'=>$this->input->post('payment_status'),'delever'=>$this->input->post('delever'));
        $update  = $this->sales->update_order($id,$data);
        if($update)
        {
            echo json_encode(array('result'=>'success','msg'=>'Order Update Success.','icon'=>'success'));
        }
        else
        {
            echo json_encode(array('result'=>'failed','msg'=>'Failed to Update Order!','icon'=>'error'));
        }
    }
}
