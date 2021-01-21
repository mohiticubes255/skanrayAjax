<?php
include_once APPPATH . "models/DBHelper.php";
class Common_model extends DBHelper {

    public function __construct() {
        parent::__construct();
    }
    public function send_mail($to,$from,$subject,$message)
    {
        $this->email->to($to);
        $this->email->from($from, $this->email_tittle);
        $this->email->subject($subject);
        $this->email->message($message);
        $send = $this->email->send();  
        if($send){
            return true;
        }
        else
        {
            return false;
        }
    }
}