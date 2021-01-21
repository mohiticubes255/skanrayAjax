<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'controllers/BaseController.php';
include_once APPPATH . 'libraries/Response_helper.php';

class Shop extends BaseController {

    public function __construct() {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->model('shop_model');
        $this->load->model('cart_model');
        $this->load->model('common_model');
        $this->load->library("pagination");

        $this->load->model('web/categories_model');
        $this->load->model('web/products_model');

        $this->response = new Response_helper();
        $this->category = $this->categories_model;
        $this->products = $this->products_model;

        $this->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_crypto']      = 'ssl';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'mohit.chack@icubeswire.com';
        $config['smtp_pass']    = '*****';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);
    
             $config['smtp_conn_options'] = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $this->email->initialize($config);    
    
            $this->email_tittle='Skanray';

            $this->email_from='mohit.chack@icubeswire.com';
            
            $this->base_domain = base_url();
    }
    public function index()
    {
        $data = array();
        $data['categories'] = $this->shop_model->get_categories();
        $data['specialities'] = $this->shop_model->get_specialities();
        $data['min_price'] = $this->shop_model->get_min_price();
        $data['max_price'] = $this->shop_model->get_max_price();
        $this->load->view('shop/index', $data);
    }
    public function fetch_data() 
    {
        $categories = $this->input->post('categories');
        $specialities = $this->input->post('specialities');
        $minimum_price = $this->input->post('minimum_price');
        $maximum_price = $this->input->post('maximum_price');
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = '#';
        $config['total_rows'] = $this->shop_model->get_count($categories,$specialities,$minimum_price,$maximum_price);
        $config['per_page'] = 9;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);

        $page = (int)($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $start = ($page - 1) * $config['per_page'];
        if($start < 0)
        {
            $start = 1;
        }
        $products = $data['products'] = $this->shop_model->get_products($config["per_page"], $start, $categories,$specialities,$minimum_price,$maximum_price);
        // var_dump($this->db->last_query());
        $list = '';
        
        foreach ($products as $product){ $image = explode("|",$product->images); $features = explode("|",$product->features);
        $img = ($image[0] != '') ? base_url().'uploads/products/'.$image[0] : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
        $list .= '<input type="hidden" id="price_'.$product->id.'" value="'.$product->dicount_price.'">
            <input type="hidden" id="quenty_'.$product->id.'" value="1">
                <div class="col-md-4 mt-2 singleProduct">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions"> <img src="'.$img.'" class="card-img img-fluid" width="96" height="350" alt=""> </div>
                        </div>
                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-2"> <a href="'.base_url().'product/'.implode("-",explode(" ",$product->product_name)).'" class="text-default mb-2" data-abc="true">'.$product->product_name.'</a> </h6> <a href="#" class="text-muted" data-abc="true">'.$features[0].'</a>
                            </div>
                            <h3 class="mb-0 font-weight-semibold"><b>Rs.'.$product->dicount_price.'</b> <del>Rs.'.$product->price.'</del> ('.number_format((float) 100 * ($product->price - $product->dicount_price) / $product->price, 2, '.', '').'%'.')</h3>
                            <div> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> </div>
                            <button type="button" class="btn bg-cart add_to_card" data-id="'.$product->id.'"><i class="fa fa-cart-plus mr-2"></i> Add to cart</button>
                        </div>
                    </div>
                </div>';
        }
        $start = ($page - 1) * $config['per_page'];
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'product_list'   => $list
        );
        echo json_encode($output);
    }
    public function product() {
        $product_name = implode(" ",explode("-",$this->uri->segment(2)));
        $where = array('product_name'=>$product_name);
        $data['product'] = $product = $this->products->get_product_with_where($where);
        $data['title'] = @$product[0]['product_name'];
        var_dump($data['product']);
        $this->load->view('shop/product_detailed',$data);
    }

    public function cart()
    {
        // var_dump($this->input->post());
        $status = $this->input->post('status');

        if($status == 'get_add_to_card_product')
        {
            $cid=$this->input->post('cid');
            $product_id=$this->input->post('product_id');
            $product_price=$this->input->post('product_price');
            $product_que=$this->input->post('product_que');
        }

        if($status == 'fill_card')
        {
            $cid=$this->input->post('cid');
            $product_id=$this->input->post('product_id');
            $price=$this->input->post('product_price');
            $que=$this->input->post('product_que');
            $product = $this->products->get_product($product_id);
            $check_cart = $this->cart_model->get_cart_with_where(array('cid'=>$cid,'product_id'=>$product_id));
            if($check_cart)
            {
                $data['quenty'] = $check_cart[0]["quenty"]+$que;
                $data['total_amount'] =$price*$data['quenty'];
                $result = $this->cart_model->add_to_cart($data, $check_cart[0]["id"]);
            }
            else
            {
                $data['cid'] = $cid;
                $data['product_id'] = $product_id;
                $data['product_name'] = $product[0]["product_name"];
                $data['price'] = $price;
                $data['quenty'] = $que;
                $data['total_amount'] = $price*$que;
                $result = $this->cart_model->add_to_cart($data);
            }

        }
        if($status == 'get_add_to_card_product')
        {
            $cid=$this->input->post('cid');
            $carts = $this->cart_model->get_updated_cart($cid);
            if($carts)
            {
                foreach($carts AS $cart)
                {
                    ?>
                     <tr>
                        <th><img src="<?php echo base_url().'uploads/products/'.@explode("|",$cart["images"])[0]; ?>" style="width:20px; height:20px" /> </th>
                        <th><?php echo @$cart["product_name"]; ?></th>
                        <th><?php echo @$cart["price"]; ?></th>
                        <th><?php echo @$cart["quenty"]; ?></th>
                        <th><button type="button" class="btn btn-sm btn-danger remove_product" data-id="<?php echo @$cart["id"]; ?>">Remove</button> </th>
                    </tr>
                        <?php
                }
                    ?>
                    <tr>
                        <th colspan="5">
                            <a href="<?php echo base_url().'shop/view_card/'.$cid; ?>"><btn btutton type="button" class="btn btn-primary btn-block">Checkout</button></a>
                        </th>
                    </tr>
                    <?php
            }
        }

        if($status == 'get_add_to_card_product_view')
        {
            $cid=$this->input->post('cid');
            $carts = $this->cart_model->get_updated_cart($cid);
            if($carts)
            {
                $total_amount=0; 
                foreach($carts AS $cart)
                {
                    $total_amount=$total_amount+$cart["total_amount"];
                    ?>
                     <tr>
                        <td><img src="<?php echo base_url().'uploads/products/'.@explode("|",$cart["images"])[0]; ?>" style="width:50px; height: 50px;" /> </td>
                        <td><?php echo @$cart["product_name"]; ?></td>
                        <td>
                        <input type="hidden" id="price_<?php echo $cart["id"] ?>" value="<?php echo @$cart["price"]; ?>">
                        <?php echo @$cart["price"]; ?>
                            
                        </td>
                        <td><a href="javascript:;" class="set_quenty" data-id="n_<?php echo @$cart["id"]; ?>"><i >N</i></a> <input type="number" id="quenty_<?php echo $cart["id"] ?>"  value="<?php echo $cart["quenty"]; ?>" readonly>
                        <a href="javascript:;" class="set_quenty" data-id="p_<?php echo @$cart["id"]; ?>"><i >P</i></a></td>
                        <td><?php echo $cart["total_amount"] ?></td>
                        <td><button type="button" class="btn btn-sm btn-danger remove_product_from_card_page" data-id="<?php echo @$cart["id"]; ?>">Remove</button></td>
                    </tr>
                        <?php
                }
                    ?>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td >Total Amount</td>
                        <td ><?php echo $total_amount; ?></td>
                        <td><a href="<?php echo base_url().'shop/checkout/'.@$cid; ?>"><button type="button" class="btn btn-block btn-primary">Checkout</button></td>
                    </tr>
                    <?php
            }
        }

        if($status == 'set_quenty')
        {
            $ids=explode("_",$this->input->post('id'));
            $data = $this->cart_model->get_cart_with_where(array('id'=>$ids[1]));
            if($ids["0"]=="n")
            {
                $que=$data[0]["quenty"]-1;
                $total_amount=$data[0]["total_amount"]-$data[0]["price"];
            }
            else
            {
                    $que=$data[0]["quenty"]+1;
                    $total_amount=$data[0]["total_amount"]+$data[0]["price"];
            }	
            if($que < 1)
            { 
                $que = 0; 
                $this->cart_model->delete_cart_products(array('id'=>$ids[1]));
            }
            if($total_amount < 1 ){ $total_amount = 0; }
            $cartArr = array('quenty'=>$que,'total_amount'=>$total_amount);
            $this->cart_model->add_to_cart($cartArr, $data[0]["id"]);
            echo json_encode(array("data"=>$data[0]));
        }

        if($status == 'remove_product')
        {
            $id=$this->input->post('id');
            $cartp = $this->cart_model->get_cart_with_where(array('id'=>$id));
            if($cartp)
            {
                
                $delete = $this->cart_model->delete_cart_products(array('id'=>$id));
                if($delete)
                {
                    echo json_encode(array("data"=>$cartp[0]));
                }
            }
            
        }
    }
    public function view_card()
    {
        $cid = $this->uri->segment(3);
        $products = $this->cart_model->get_updated_cart($cid);
        if($this->uri->segment(3) && $products)
        {
            $data['products'] = $this->cart_model->get_updated_cart($cid);
        }else{
            redirect(base_url().'shop');
        }
        $this->load->view('shop/view_cart',$data);
    }

    public function checkout()
    {
        $cid = $this->uri->segment(3);
        $products = $this->cart_model->get_updated_cart($cid);
        if($this->uri->segment(3) && $products)
        {
            $data['products'] = $this->cart_model->get_updated_cart($cid);
        }else{
            redirect(base_url().'shop');
        }
        $this->load->view('shop/checkout',$data);
    }
    public function invoice()
    {
        $cid = $this->input->post('cid');
        $products = $this->cart_model->get_updated_cart($cid);
        if($products)
        {
            $product_total = $this->cart_model->get_total_booked_products($cid);
            if(@$product_total[0]["total_product"]>0)
            {
                $order = array();
                $order['name'] = $this->input->post('name');
                $order['email'] = $this->input->post('email');
                $order['contact'] = $this->input->post('contact');
                $order['city'] = $this->input->post('city');
                $order['date'] = date("Y-m-d H:i:s");
                $order['total_product'] = $product_total[0]["total_product"];
                $order['total_amount'] = $product_total[0]["total_amount"];
                $order['payment_type'] = 'COD';
                $order['payment_status'] = 'Pending';
                $order['delever'] = 'Pending';
                $data["order_id"] = $order_id = $this->cart_model->add_order($order);
                if($order_id)
                {
                    foreach($products AS $product)
                    {
                        $order_productsArr = array();
                        $order_productsArr['order_id'] = $order_id;
                        $order_productsArr['product_id'] = $product['product_id'];
                        $order_productsArr['product_name'] = $product['product_name'];
                        $order_productsArr['price'] = $product['price'];
                        $order_productsArr['quenty'] = $product['quenty'];
                        $order_productsArr['total_amount'] = $product['total_amount'];
                        $order_product_id = $this->cart_model->add_order_products($order_productsArr);
                        if($order_product_id)
                        {
                            $this->cart_model->delete_cart_products(array('cid'=>$cid));
                        }
                    }
                    $subject = 'Skanray order is placed.';
                    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><meta content="width=device-width, initial-scale=1" name="viewport"><title>Skanray Order Details.</title><!-- Robot header image designed by Freepik.com --><style type="text/css">
                        @import url(https://fonts.googleapis.com/css?family=Droid+Sans);
                    
                        /* Take care of image borders and formatting */
                    
                        img {
                        max-width: 600px;
                        outline: none;
                        text-decoration: none;
                        -ms-interpolation-mode: bicubic;
                        }
                    
                        a {
                        text-decoration: none;
                        border: 0;
                        outline: none;
                        color: #bbbbbb;
                        }
                    
                        a img {
                        border: none;
                        }
                    
                        /* General styling */
                    
                        td, h1, h2, h3  {
                        font-family: Helvetica, Arial, sans-serif;
                        font-weight: 400;
                        }
                    
                        td {
                        text-align: center;
                        }
                    
                        body {
                        -webkit-font-smoothing:antialiased;
                        -webkit-text-size-adjust:none;
                        width: 100%;
                        height: 100%;
                        color: #37302d;
                        background: #ffffff;
                        font-size: 16px;
                        }
                    
                        table {
                        border-collapse: collapse !important;
                        }
                    
                        .headline {
                        color: #ffffff;
                        font-size: 36px;
                        }
                    
                        .force-full-width {
                        width: 100% !important;
                        }
                    
                    
                    
                    
                        </style><style media="screen" type="text/css">
                            @media screen {
                                /*Thanks Outlook 2013! https://goo.gl/XLxpyl*/
                            td, h1, h2, h3 {
                                font-family: "Droid Sans", "Helvetica Neue", "Arial", "sans-serif" !important;
                            }
                            }
                        </style><style media="only screen and (max-width: 480px)" type="text/css">
                        /* Mobile styles */
                        @media only screen and (max-width: 480px) {
                    
                            table[class="w320"] {
                            width: 320px !important;
                            }
                    
                    
                        }
                        </style><style type="text/css"></style></head><body bgcolor="#ffffff" class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
                    <table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%">
                    <tbody><tr>
                    <td align="center" bgcolor="#ffffff" class="" valign="top" width="100%">
                    <center class=""><table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
                    <tbody><tr>
                    <td align="center" class="" valign="top"><table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="100%">
                    <tbody><tr>
                    <td class="" style="font-size: 30px; text-align:center;"></td>
                    </tr>
                    </tbody></table>
                    <table bgcolor="#008ACE" cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="100%">
                    <tbody class=""><tr class="">
                    <td class=""><br>
                    <img alt="robot picture" class="" height="70" src="https://d1pgqke3goo8l6.cloudfront.net/onWRO1YrQiiubAgCRwAx_white_logo.png" width="70">
                    <br></td>
                    </tr>
                    <tr class=""><td class="headline">Welcome to Skanray!</td></tr>
                    <tr>
                    <td>
                    <center class=""><table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="75%"><tbody class=""><tr class="">
                    <td class="" style="color:#A0D8F4;"><br>
                    We would like to greet you with an awesome present. Your order will delivere within 7 days. Your order No. is '.$order_id.' .
                                                <br>
                    <br>
                    <img alt="robot picture" class="" height="175" src="https://d1pgqke3goo8l6.cloudfront.net/QD14ubhGQDOjkvpoR4Al_green4.png" width="175">
                    <br>
                    <br></td>
                    </tr>
                    </tbody></table></center>
                    </td>
                    </tr>
                    <tr>
                    <td class="">
                    <div class=""><!--[if mso]>
                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:300px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                                                <w:anchorlock></w:anchorlock>
                                                <center>
                                            <![endif]-->
                    <a class="" data-click-track-id="6155" href="http://" style="background-color:#73BD4D;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:normal;line-height:50px;text-align:center;text-decoration:none;width:350px;-webkit-text-size-adjust:none;">Order Number - '.$order_id.'</a>
                    <!--[if mso]>
                                                </center>
                                            </v:roundrect>
                                            <![endif]--></div>
                    <br>
                    <br>
                    </td>
                    </tr>
                    </tbody></table>
                    </body></html>';
                    $send = $this->common_model->send_mail($this->input->post('email'),$this->email_from,$subject,$message);
                }
                $this->load->view('shop/success',$data);
            }
            
        }else{
            redirect(base_url().'shop');
        }
    }
    public function send_mail()
    {
        $to = 'mohit.chack@icubeswire.com';
        $from = 'mohit.chack@icubeswire.com';
        $subject = 'Skanray';
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><meta content="width=device-width, initial-scale=1" name="viewport"><title>Neopolitan Welcome Email</title><!-- Designed by https://github.com/kaytcat --><!-- Robot header image designed by Freepik.com --><style type="text/css">
          @import url(https://fonts.googleapis.com/css?family=Droid+Sans);
        
          /* Take care of image borders and formatting */
        
          img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
          }
        
          a {
            text-decoration: none;
            border: 0;
            outline: none;
            color: #bbbbbb;
          }
        
          a img {
            border: none;
          }
        
          /* General styling */
        
          td, h1, h2, h3  {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
          }
        
          td {
            text-align: center;
          }
        
          body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
            font-size: 16px;
          }
        
           table {
            border-collapse: collapse !important;
          }
        
          .headline {
            color: #ffffff;
            font-size: 36px;
          }
        
         .force-full-width {
          width: 100% !important;
         }
        
        
        
        
          </style><style media="screen" type="text/css">
              @media screen {
                 /*Thanks Outlook 2013! https://goo.gl/XLxpyl*/
                td, h1, h2, h3 {
                  font-family: "Droid Sans", "Helvetica Neue", "Arial", "sans-serif" !important;
                }
              }
          </style><style media="only screen and (max-width: 480px)" type="text/css">
            /* Mobile styles */
            @media only screen and (max-width: 480px) {
        
              table[class="w320"] {
                width: 320px !important;
              }
        
        
            }
          </style><style type="text/css"></style></head><body bgcolor="#ffffff" class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
        <table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody><tr>
        <td align="center" bgcolor="#ffffff" class="" valign="top" width="100%">
        <center class=""><table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
        <tbody><tr>
        <td align="center" class="" valign="top"><table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="100%">
        <tbody><tr>
        <td class="" style="font-size: 30px; text-align:center;"></td>
        </tr>
        </tbody></table>
        <table bgcolor="#008ACE" cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="100%">
        <tbody class=""><tr class="">
        <td class=""><br>
        <img alt="robot picture" class="" height="70" src="https://d1pgqke3goo8l6.cloudfront.net/onWRO1YrQiiubAgCRwAx_white_logo.png" width="70">
        <br></td>
        </tr>
        <tr class=""><td class="headline">Welcome to ZenMate!</td></tr>
        <tr>
        <td>
        <center class=""><table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="75%"><tbody class=""><tr class="">
        <td class="" style="color:#A0D8F4;"><br>
        We would like to greet you with an awesome present. Confirm your account and get 7 days of <span style="font-weight:bold;" class="">Zen</span><span style="font-weight:lighter;" class="">Mate</span> Premium for FREE!
                                    <br>
        <br>
        <img alt="robot picture" class="" height="175" src="https://d1pgqke3goo8l6.cloudfront.net/QD14ubhGQDOjkvpoR4Al_green4.png" width="175">
        <br>
        <br></td>
        </tr>
        </tbody></table></center>
        </td>
        </tr>
        <tr>
        <td class="">
        <div class=""><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:300px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                                  <w:anchorlock></w:anchorlock>
                                  <center>
                                <![endif]-->
        <a class="" data-click-track-id="6155" href="http://" style="background-color:#73BD4D;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:normal;line-height:50px;text-align:center;text-decoration:none;width:350px;-webkit-text-size-adjust:none;">Verify Account and Start My Premium</a>
        <!--[if mso]>
                                  </center>
                                </v:roundrect>
                              <![endif]--></div>
        <br>
        <br>
        </td>
        </tr>
        </tbody></table>
        <table bgcolor="#f5774e" cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="100%"><tbody class=""><tr class=""><td class="headline" style="border-right: solid; border-left: solid; background-color:#ffffff; color:#008ACE"><br>
        Meet ZenMate Premium</td></tr>
        <tr class=""><td class="" style="background-color: #ffffff; border-right:solid; border-left:solid; color: #008ACE;"><br>
        <img alt="meter image" class="" height="128" src="https://d1pgqke3goo8l6.cloudfront.net/Qp6KeZ6QKars66zJoRHA_turbospeed.png" width="12">
        &nbsp;&nbsp;&nbsp;
        <img alt="meter image" class="" height="89" src="https://www.filepicker.io/api/file/tjUsYjIHSDCkrrniLuev" width="145">
        &nbsp;&nbsp;&nbsp;
        <img alt="meter image" class="" height="89" src="https://www.filepicker.io/api/file/tjUsYjIHSDCkrrniLuev" width="145">
        <br>
        <br></td></tr>
        <tr class="">
        <td class=""><center cellspacing="0" class="" style="background-color: #ffffff; border-right:solid; border-left:solid; color: #008ACE;"></center></td>
        </tr>
        <tr class=""><td class="" style="background-color: #ffffff; border-right:solid; border-left:solid; color: #008ACE;"><div class=""><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#ffff">
                                  <w:anchorlock></w:anchorlock>
                                  <center>
                                <![endif]-->
        <a class="" data-click-track-id="9183" href="http://" style="background-color:none;border-radius:4px; border: solid 1px; color:#008ACE;display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:lighter;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">See All Benefits&gt;</a>
        <!--[if mso]>
                                  </center>
                                </v:roundrect>
                              <![endif]--></div>
        <br>
        <br></td></tr></tbody></table>
        <table bgcolor="#414141" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
        <tbody><tr class=""><td class="" style="background-color:#414141;"></td></tr>
        <tr>
        <td class="" style="color:#bbbbbb; font-size:12px;"></td>
        </tr>
        <tr>
        <td class="" style="color:#bbbbbb; font-size:12px;"><br>
        <br>
        <a class="" data-click-track-id="6245" href="#">Terms of Service</a> 
        &nbsp; • &nbsp; 
        <a class="" data-click-track-id="285" href="#">Privacy Policy</a>
        &nbsp; • &nbsp; 
        <a class="" data-click-track-id="3945" href="#">Support</a>
        &nbsp; • &nbsp; 
        <a class="" data-click-track-id="5389" href="#">Imprint</a>
        <br><br>
        <img alt="facebook" class="" height="32px" src="https://d1pgqke3goo8l6.cloudfront.net/D11l6OhhRVaZGnYCaxtu_Facebook@3x.png" width="32px">
        &nbsp;
        <img alt="facebook" class="" height="32px" src="https://d1pgqke3goo8l6.cloudfront.net/fRII6ZJ9SEugqa31ignG_Twitter@3x.png" width="32px">
        &nbsp;
        <img alt="facebook" class="" height="32px" src="https://d1pgqke3goo8l6.cloudfront.net/fVAAOjVyR2mKHKgYR1SF_GooglePlus3x.png" width="32px">
        <br>
        <br>
        © 2015 <span class="" style="font-weight:bold;">Zen</span><span class="" style="font-weight:lighter;">Mate</span>
        <br>
        <br></td>
        </tr>
        </tbody></table></td>
        </tr>
        </tbody></table></center>
        </td>
        </tr>
        </tbody></table>
        </body></html>';
        $send = $this->common_model->send_mail($to,$from,$subject,$message);
        if($send){
            echo 'Mail Send';
        }else{
            echo 'Failed';
        }
    }
}