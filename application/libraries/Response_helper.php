<?php
class Response_helper {

	public function response($status, $response_code, $msg = FALSE, $data = FALSE)
	{
		$result = array();
		$result['result'] = $status;
		$result['response_code'] = $response_code;
		$result['msg'] = $msg;
		$result['data'] = $data;
		//log_message('error', "POST data: ".json_encode($_POST));
		//log_message('error', "Response data: ".json_encode($result));
		return $result;
	}

	public function invalid_request(){
		return $this->response(STATUS_FAILED, RESPONSE_INVALID_REQUEST, "Invalid Request", array());
	}

	public function not_found(){
		return $this->response(STATUS_FAILED, RESPONSE_NOT_FOUND, "Data not found.", array());
	}

	public function unauthorised(){
		return $this->response(STATUS_FAILED, RESPONSE_UNAUTHORIZED, "Un-Authorised Access.", array());
	}

	public function internal_error(){
		return $this->response(STATUS_FAILED, RESPONSE_INTERNAL_ERROR, "Internal Server Error", array());
	}
	public function invalid_headers (){
		return $this->response(STATUS_FAILED, RESPONSE_UNAUTHORIZED, "Invalid Headers.", array());
	}

	public function access_denied() {
		return $this->response(STATUS_FAILED, RESPONSE_UNAUTHORIZED, ACCESS_DENIED, array());
	}
}
