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
                            // var_dump($lists["data"]);
                            ?>
                            <!--begin::Portlet-->
                            <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Manage Products
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">
                                        <ul class="m-portlet__nav">
                                            <li class="m-portlet__nav-item" data-toggle="m-tooltip" data-placement="top" title="Add new Product">
                                                <a href="<?php echo base_url('web/catalog/add_product')?>" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-plus"></i></a>
                                            </li>
                                            <li class="m-portlet__nav-item">
                                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon" data-toggle="m-tooltip" data-placement="top" title="Reload"><i class="la la-refresh"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <table class="table table-striped- table-bordered table-hover table-checkable" id="category-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($lists['data'] as $product) { ?>                                       
                                        <tr>
                                                <td><?= $product[0]; ?></td>
                                                <td><?= $product[2]; ?></td>
                                                <td><b>Rs.<?= $product[5]; ?></b> <del>Rs.<?= $product[4]; ?></del>  (-<?= number_format((float)$product[6], 2, '.', '').'%'; ?>)</td>
                                                <td>
                                                	<?= $product[8]; ?>
                                                	<button class="btn btn-danger btn-sm rounded-0 remove_product_btn" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-product_id="<?= $product[0]; ?>"><i class="fa fa-trash"></i></button>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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
<script>
    $('.category').select2({
        placeholder: "Select a Parent Category",
        allowClear: true
    });
    $('#category-table').DataTable();
</script>
<!-- end::Body -->

</html>