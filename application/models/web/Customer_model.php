<?php
include_once APPPATH . "models/DBHelper.php";
include_once APPPATH . "models/helper_methods/Users.php";
include_once APPPATH . "models/helper_methods/Common.php";
class Customer_model extends DBHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->user = new Users();
        $this->common = new Common();
        $this->response = new Response_helper();
    }

    public function add_customer($user_id = FALSE)
    {
        $data['display_name'] = ucwords(strtolower($this->input->post('name')));
        $data['email'] = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $data['mobile'] = $this->input->post('mobile');
        $role = $this->input->post('type');

        $data['activated'] = $this->input->post('status');
        if ($user_id) {
            // Update User
            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            return $this->user->update_user($data, $user_id);
        }
        // Create New User
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $data['role'] = ROLE_USER;
        if ($role) {

            $data['role'] = ROLE_DELIVERY;
        }
        return $this->user->add_user($data);
    }


    public function get_users($type = false)
    {
        if (!$type) {
            $type = ROLE_USER;
        }

        $data_tables = $this->common->datatables_config();
        $order_by = TABLE_USERS . ".id ASC";
        if ($data_tables['order']) {
            $column = $data_tables['order'][0]['column'];
            $order_dir = $data_tables['order'][0]['dir'];
        }
        $where = "role=" . $type;
        $select = TABLE_USERS . ".id, email, mobile, display_name, activated";
        if ($data_tables['search']) {
            $search = $data_tables['search'];
            $where .= " AND (email LIKE '%$search%' OR display_name LIKE '%$search%' OR mobile LIKE '%$search%')";
        }
        if ($data_tables['order']) {
            if ($column > 0) {
                // $order_by = $this->get_order_by($column, $order_dir);
            }
        }

        $result = array();
        $total_users = $this->count(TABLE_USERS, array('role' => $type));
        $users = $this->user->get_users_list($where, $data_tables['limit'], $data_tables['offset'], $order_by);
        foreach ($users as $user) {
            $tmp = array();
            $tmp[] = "<input class='user_id' type='checkbox' name='user_id[]' value='" . $user['id'] . "'/>";
            $tmp[] = $user['display_name'];
            $tmp[] = $user['email'];
            $tmp[] = $user['mobile'];
            $tmp[] = ($user['activated'] == 'y' ? 'Enabled' : 'Disabled');
            $tmp[] = '<a href="' . base_url("web/customers/edit_customer/" . $user['id']) . '"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';

            array_push($result, $tmp);
        }
        $response = array();
        $response['draw'] = $data_tables['draw']++;
        $response['recordsTotal'] = count($result);
        $response['recordsFiltered'] = $total_users;
        $response['data'] = $result;
        return $response;
    }

    public function get_customer($user_id)
    {
        return $this->user->get_user_details($user_id);
    }

    public function remove_user()
    {
        $ids = $this->input->post('ids');
        $ids = explode(",", $ids);
        if ($ids) {
            foreach ($ids as $id) {
                $this->user->remove_user($id);
            }
        }
        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "User has been Removed.", array());
    }

    public function get_delivery_boys() {
        return $this->select("id, display_name", TABLE_USERS, array('activated' => 'y', 'role' => ROLE_DELIVERY));
    }
}
