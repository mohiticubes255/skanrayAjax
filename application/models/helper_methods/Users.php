<?php
include_once APPPATH . "models/Db_Helper.php";

class Users extends Db_Helper
{

    public function __construct()
    {
        parent::__construct();
        $this->response = new Response_helper();
    }

    public function add_user($data)
    {
        $email = $data['email'];
        $mobile = $data['mobile'];
        $mobile_exists = $this->count(TABLE_USERS, array('mobile' => $mobile));
        if ($mobile_exists) {
            return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Mobile Number is Already Exists.", array());
        }
        $email_exists = $this->count(TABLE_USERS, array('email' => $email));

        if ($email_exists) {
            return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Email is Already Exists.", array());
        }

        $user_id = $this->insert(TABLE_USERS, $data);
        if ($user_id) {
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Customer has been Registered.", array());
        }
        return $this->response->internal_error();
    }

    public function update_user($data, $user_id)
    {
        $email = $data['email'];
        $mobile = $data['mobile'];

        $user = $this->select("email, mobile", TABLE_USERS, array('id' => $user_id), false, 1);
        if ($user) {
            $db_email = $user[0]['email'];
            $db_mobile = $user[0]['mobile'];

            if ($db_email != $email) {
                $email_exists = $this->count(TABLE_USERS, array('email' => $email));

                if ($email_exists) {
                    return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Email is Already Exists.", array());
                }
            }

            if ($db_mobile != $mobile) {
                $mobile_exists = $this->count(TABLE_USERS, array('mobile' => $mobile));
                if ($mobile_exists) {
                    return $this->response->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Mobile Number is Already Exists.", array());
                }
            }

            $this->update(TABLE_USERS, $data, array('id' => $user_id));
            return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Customer has been Updated.", array());
        }
        return $this->response->invalid_request();
    }


    public function count_all_users()
	{
		return $this->count(TABLE_USERS, array('role' => ROLE_USER));
    }
    


    public function get_users_list($where, $limit, $offset, $order_by)
    {
        return $this->select("*", TABLE_USERS, $where, $order_by, $limit, $offset);
    }


    public function get_user_details($user_id)
    {
        return $this->select("*", TABLE_USERS, array('id' => $user_id), false, 1);
    }

    public function remove_user($user_id)
    {
        $this->delete(TABLE_USERS, array('id' => $user_id));
    }

    public function login($email, $password, $role)
    {
        if ($email and $password) {
            $user = $this->select("id, display_name, email, mobile, profile, password, activated, verified_email, verified_mobile", TABLE_USERS, array('email' => $email, 'role' => $role), false, 1);
            if ($user) {
                //check other informations
                if($user[0]['verified_email'] === 'n'){
                    return $this->response->response(STATUS_FAILED, RESPONSE_STATUS_OK, "Please verify your Email First.", array());
                }

                if($user[0]['verified_mobile'] === 'n'){
                    return $this->response->response(STATUS_FAILED, RESPONSE_STATUS_OK, "Please verify your Mobile First.", array());
                }

                if($user[0]['activated'] === 'n'){
                    return $this->response->response(STATUS_FAILED, RESPONSE_STATUS_OK, "Your account has been blocked.", array());
                }
                $db_pass = $user[0]['password'];
                if (password_verify($password, $db_pass)) {
                    $access_token = $this->create_access_token($user[0]['id']);
                    if ($access_token) {
                        $data['id'] = $user[0]['id'];
                        $data['display_name'] = $user[0]['display_name'];
                        $data['email'] = $user[0]['email'];
                        $data['mobile'] = $user[0]['mobile'];
                        $data['access_token'] = $access_token;
                        $response = array();
                        array_push($response, $data);
                        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Login Successfully.", $response);
                    }
                } else {
                    return $this->response->response(STATUS_FAILED, RESPONSE_STATUS_OK, "Login Failed. Incorrect Password.", array());
                }
            }
            return $this->response->response(STATUS_FAILED, RESPONSE_STATUS_OK, "No user found with this Email.", array());
        }
        return $this->response->invalid_request();
    }

    public function logout ($user_id, $access_token) {
        $this->delete(TABLE_ACCESS_TOKEN, array('user_id'=>$user_id, 'access_token'=>$access_token));
        return $this->response->response(STATUS_SUCCESS, RESPONSE_STATUS_OK, "Logout Successfully.", array());
    }
    private function create_access_token($user_id)
    {
        if ($user_id) {
            $data = array();
            $data['user_id'] = $user_id;
            $data['access_token'] = md5(mt_rand());
            $data['last_login'] = date('Y-m-d H:i:s');
            if ($this->insert(TABLE_ACCESS_TOKEN, $data)) {
                return $data['access_token'];
            }
        }
        return false;
    }


}
