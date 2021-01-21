<?php
include_once APPPATH . "models/DBHelper.php";
class Common extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
    }

    public function datatables_config()
    {
        $data['draw'] = $this->input->post('draw');
        $data['offset'] = $this->input->post('start');
        $data['limit'] = $this->input->post('length');
        $data['order'] = $this->input->post('order');
        $search = $this->input->post('search');
        @$data['search'] = $search['value'];
        return $data;
    }
}
