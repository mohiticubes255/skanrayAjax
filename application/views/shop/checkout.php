<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sipping</title>
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
  <div class="col-sm-8">
     <div class="well">
     <h3>Card -> <a href="<?php echo base_url().'shop';?>">Go To Shop</a></h3>
     <h3>Sipping</h3>
     
     <form action="<?php echo base_url().'shop/invoice';?>" method="post">
       <input type="hidden" name="cid" value="<?php echo $this->uri->segment(3); ?>">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label for="InputName">Name</label>
              <input type="text" name="name"  class="form-control" placeholder="Enter Name" required="treu">
              <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label for="InputName">E-mail</label>
              <input type="email" name="email"  class="form-control" placeholder="Enter E-mail" required="treu">
              <span class="text-danger"></span>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label for="InputName">Contact</label>
              <input type="number" name="contact"  class="form-control" placeholder="Enter number" required="treu">
              <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label for="InputName">City</label>
              <input type="text" name="city"  class="form-control" placeholder="Enter City" required="treu">
              <span class="text-danger"></span>
            </div>
        </div>
      </div>
       <div class="row">
        <div class="col-md-12">
           <label for="InputName">Sipping Address</label>
           <textarea name="address" cols="50" rows="4" class="form-control" placeholder="Address"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
           <label for="InputName">Payment Method : COD</label>
           
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <button type="submit" class="btn btn-danger btn-block">Book</button>
        </div>
      </div>
     </form>

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