<!DOCTYPE html>
<html lang="en">
<head>
  <title>Order Success</title>
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
<br>
<div class="container">
<div class="row">
  <div class="col-sm-8">
     <div class="well">
     <h1>Thank You</h1>
<h4>Your order is booked and Your Order ID is :<?php echo @$order_id; ?> <a href="<?php base_url().'shop'; ?>">Go To Shop</a></h4>
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