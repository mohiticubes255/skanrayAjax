<?php

class Image_library
{
    private $_CI;
    public function __construct()
    {
        $this->_CI = &get_instance();
    }

    public function upload_products($file)
    {
        $dir = FCPATH . 'uploads/products/';
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $config['image_library'] = 'gd2';
        $config['upload_path']          = FCPATH . 'uploads/products/';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['encrypt_name']        =  true;

        return $this->upload($file, $config);
    }

    public function upload_student_documents($file)
    {
        $config['image_library'] = 'gd2';
        $config['upload_path']          = FCPATH . 'assets/Studentuploads/';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['encrypt_name']        =  true;

        return $this->upload($file, $config);
    }

    private function upload($file, $config)
    {
        $this->_CI->load->library('upload', $config);
        $result = array();
        if($file){
        if ($this->_CI->upload->do_upload($file)) {
                    $result['data'] = $this->_CI->upload->data();
                    $result['error'] = false;
                    $ext = explode('.', $result['data']['file_name']);
                    if ($ext[count($ext) - 1] != 'pdf') {
                        $this->resize_image($result['data'], $config['upload_path']);
                    }
                } else {
                    $result['error'] = $this->_CI->upload->display_errors();
                }
        }else {
             $result['error'] = $this->_CI->upload->display_errors();
        }
        return $result;
    }

    private function resize_image($data, $path)
    {
        $file_name = $data['file_name'];
        $config['image_library'] = 'gd2';
        $config['source_image'] = "$path/$file_name";
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 800;
        $config['height']       = 600;

        $this->_CI->load->library('image_lib', $config);

        $this->_CI->image_lib->resize();
    }
}
