<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

    .carousel-inner img {
      width: 100%; /* Set width to 100% */
      min-height: 200px;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
      .carousel-caption {
        display: none; 
      }
    }
  </style>
</head>
<body>

<div class="container">
<div class="row">
  <div class="col-sm-10">
     <div class="well">
     <h3>Card -> <a href="<?php echo base_url().'shop';?>">Go To Shop</a></h3>
      <table class="table table-bordered">
    <thead>
      <tr>
        <th>Image</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quenty</th>
        <th>Total Amount</th>
        <th>Action</th>
      </tr>
    </thead>
 
    <tbody id="show_card_produst_dsp_view_card">
      <?php 
$total_amount=0;
      foreach($products AS $product){
        $total_amount=$total_amount+$product["total_amount"];
        ?>
       <tr>
        <td><img src="<?php echo base_url().'uploads/products/'.@explode("|",$product["images"])[0]; ?>" style="width:50px; height: 50px;" /> </td>
        <td><?php echo @$product["product_name"]; ?></td>
        <td>
          <input type="hidden" id="price_<?php echo $product["id"] ?>" value="<?php echo @$product["price"]; ?>">
          <?php echo @$product["price"]; ?>
            
          </td>
        <td><a href="javascript:;" class="set_quenty" data-id="n_<?php echo @$product["id"]; ?>"><i >N</i></a> <input type="number" id="quenty_<?php echo $product["id"] ?>"  value="<?php echo $product["quenty"]; ?>">
          <a href="javascript:;" class="set_quenty" data-id="p_<?php echo @$product["id"]; ?>"><i >P</i></a></td>
        <td><?php echo $product["total_amount"]; ?></td>
        <td><button type="button" class="btn btn-sm btn-danger remove_product_from_card_page" data-id="<?php echo @$product["id"]; ?>">Remove</button></td>
      </tr>
        <?php
      } ?>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td >Total Amount</td>
        <td ><?php echo $total_amount; ?></td>
        <td><a href="<?php echo base_url().'shop/checkout/'.$this->uri->segment(3); ?>"><button type="button" class="btn btn-block btn-primary">Checkout</button></td>
      </tr>
    
    </tbody>
  </table>

    </div>
  </div>
  
</div>
<hr>
</div>

<!-- CART SCRIPT START -->
<script>
var BASE_URL = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url().'assets/js/cart.js';?>"></script>

<!-- CART SCRIPT END -->