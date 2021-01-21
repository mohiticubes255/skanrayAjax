<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Catalog | <?php echo WEBSITE_TITLE; ?></title>
    <?php include_once VIEWPATH . "/admin/includes/head.php"; ?>
    <link href="<?php echo base_url('assets/css/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        <!-- BEGIN: Header -->
        <?php include_once VIEWPATH . "/admin/includes/header.php"; ?>

        <!-- END: Header -->

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <?php include_once VIEWPATH . "/admin/includes/sidebar.php"; ?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="m-content">

                    <!--Begin::Section-->
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            // var_dump($lists);
                            ?>
                            <!--begin::Portlet-->
                            <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Manage Product
                                            </h3>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="m-portlet__body">
                                    <form method="post" id="edit_product_form" enctype="multipart/form-data"> 
                                        <input type="hidden" name="id" value="<?= $product[0]['id']; ?>">
                                        <input type="hidden" name="action" value="update_product">
                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label">Product Name</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $product[0]['product_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="form-control-label">Product Category</label>
                                            <select class="category form-control" name="category_id" id="category_id" required>
                                                <option selected disabled value="">--SELECT CATEGORY--</option>
                                                <?php
                                                foreach ($categories as $categorie) {
                                                ?>
                                                <option value="<?= $categorie['cat_id']; ?>" <?php if($categorie['cat_id'] == $product[0]['category_id']){ echo 'selected';} ?>><?= $categorie['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label">Product Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" value="<?= $product[0]['price']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label">Product Discount Price</label>
                                                    <input type="number" class="form-control" id="dicount_price" name="dicount_price" value="<?= $product[0]['dicount_price']; ?>" required>
                                                </div>
                                             </div>    
                                        </div>
                                             

                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label">Product Features</label>
                                            <!-- <input type="text" class="form-control" id="features" name="features" required> -->
                                            <div class="table-responsive">  

                                                <table class="table" id="dynamic_field">

                                                    
                                                        <tbody>
                                                        <?php
                                                        $features = explode('|',$product[0]['features']);
                                                        $f = 0;
                                                        foreach($features AS $feature){ ?>
                                                          

                                                              

                                                             

                                                            <?php 
                                                            if($f == 0){ ?>
                                                            <tr id="row<?=$f;?>" class="featuresrow">
                                                                <td style="border:none!important;padding:0px 8px;"><input type="text" name="features[]" placeholder="Product Features" class="form-control name_list" value="<?=$feature;?>" required=""></td>
                                                                <td style="border:none!important;padding:0px 8px;"><button style="margin-top: 3px;" type="button" name="add" id="add" class="btn btn-info"><i class="fa fa-plus"></i></button></td>
                                                                </tr>
                                                            <?php }elseif($f > 0){ ?>
                                                            <tr id="row<?=$f;?>" class="dynamic-added featuresrow">
                                                                <td style="border:none!important;padding:0px 8px;"><input type="text" name="features[]" placeholder="Product Features" class="form-control name_list" value="<?=$feature;?>" required=""></td>
                                                                <td style="border:none!important;padding:0px 8px;"><button style="margin-top: 3px;" type="button" name="remove" id="<?=$f;?>" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td>
                                                            </tr>
                                                            <?php } ?>
                                                            
                                                        
                                                        
                                                        <?php 
                                                        $f++;
                                                        } ?>

                                                </tbody></table>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label">Product Summary</label>
                                            <textarea name="product_summary" class="form-control" id="product_summary" required><?= $product[0]['summary']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label">Product Description</label>
                                            <textarea name="product_description" class="form-control" id="product_description" required><?= $product[0]['description']; ?></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="files" class="form-control-label">Product Images</label>
                                            <input class="form-control" id="files" type="file" name="images[]" multiple accept="image/x-png,image/gif,image/jpeg"/>
                                            <output id="result" />
                                            <?php
                                            if($product[0]['images'])
                                            {
                                                $images = explode('|',$product[0]['images']);
                                                foreach($images AS $image){ ?>
                                                <div><img class="thumbnail" src="<?= base_url().'uploads/products/'.$image;?>">
                                                </div>
                                                <?php 
                                                } 
                                            }?>
                                            </output>
                                        </div>

                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label">Product Status</label><br>
                                            <label class="switch">
                                              <input type="checkbox" name="status" <?php if($product[0]['status'] == 'y'){ echo 'checked';} ?>>
                                              <span class="slider"></span>
                                            </label>
                                        </div>

                                        <center><button type="submit" class="btn btn-primary">UPDATE</button></center>
                                        
                                </div>
                                    
                                </form>

                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>
                    </div>

                    <!--End::Section-->
                </div>
            </div>
        </div>

        <!-- end:: Body -->

        <!-- begin::Footer -->
        <?php include_once VIEWPATH . "/admin/includes/footer.php"; ?>
        <script src="<?php echo base_url('assets/js/datatables.bundle.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
        <!-- end::Footer -->
    </div>

    <!-- end:: Page -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>


    <!--begin::Page Scripts -->

    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>