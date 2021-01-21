<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Home extends BaseController {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$this->load->view('admin/dashboard');
	}
}
