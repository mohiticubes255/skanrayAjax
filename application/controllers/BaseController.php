<?php


class BaseController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Upload Image Function
    */
   public function upload($width, $height, $image_name = FALSE, $resize = TRUE)
   {
       $this->load->library('image_library');
       return $this->image_library->upload($width, $height, $image_name, $resize);
   }
}