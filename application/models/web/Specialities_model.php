<?php
include_once APPPATH . "models/DBHelper.php";
include_once APPPATH . "models/helper_methods/Common.php";
include_once APPPATH . "models/helper_methods/Specialities.php";
class Specialities_model extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->response = new Response_helper();
        $this->common = new Common();
        $this->products = new Products();
        $this->specialities = new specialities();
    }
    public function save_speciality($speciality_id = FALSE)
    {
        $speciality_id = $this->input->post('speciality_id');
        $name = $this->input->post('speciality_name');
        $data['speciality_name'] = $name;
        $data['speciality_creation'] = date("Y-m-d H:i:s");

        return $this->specialities->save_speciality($data, $speciality_id);
    }
    public function get_specialities()
    {
        $data_tables = $this->common->datatables_config();
        $order_by = TABLE_SPECIALITIES . ".SPECIALITYID ASC";
        if ($data_tables['order']) {
            $column = $data_tables['order'][0]['column'];
            $order_dir = $data_tables['order'][0]['dir'];
        }
        $where = false;
        $select = TABLE_SPECIALITIES . ".* ";
        if ($data_tables['search']) {
            $search = $data_tables['search'];
            $where = "(speciality_name LIKE '%$search%' OR speciality_name LIKE '%$search%')";
        }
        if ($data_tables['order']) {
            if ($column > 0) {
                // $order_by = $this->get_order_by($column, $order_dir);
            }
        } 

        $result = array();
        $total_specialities = $this->specialities->count_specialities($where);
        $specialities = $this->specialities->get_specialities($select, $where, $order_by, $data_tables['limit'], $data_tables['offset']);
        foreach ($specialities as $speciality) {
            $tmp = array();
            $tmp[] = "<input type='checkbox' class='speciality' value='" . $speciality['SPECIALITYID'] . "' name='sid[]' />";
            $tmp[] = $speciality['SPECIALITYID'];
            $tmp[] = $speciality['speciality_name'];
            $tmp[] = ($speciality['speciality_status'] == 'y' ? 'Enabled' : 'Disabled');
            array_push($result, $tmp);
        }
        $response = array();
        $response['draw'] = $data_tables['draw']++;
        $response['recordsTotal'] = count($result);
        $response['recordsFiltered'] = $total_specialities;
        $response['data'] = $result;
        return $response;
    }
    public function get_speciality($speciality_id)
    {
        return $this->select("*", TABLE_SPECIALITIES, array('SPECIALITYID' => $speciality_id), false, 1);
    }
    public function remove_speciality()
    {
        $ids = $this->input->post('ids');
        $ids = explode(",", $ids);
        if ($ids) {
            foreach ($ids as $id) {
                $this->delete(TABLE_SPECIALITIES, array('SPECIALITYID'=>$id));
            }
        }
        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Categories has been Removed.", array());
    }

}
