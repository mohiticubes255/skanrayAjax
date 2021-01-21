<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Catalog | <?php echo WEBSITE_TITLE; ?></title>
    <?php include_once VIEWPATH . "/admin/includes/head.php"; ?>
    <link href="<?php echo base_url('assets/css/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
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
                                                Orders
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">
                                        <ul class="m-portlet__nav">
                                            <li class="m-portlet__nav-item" data-toggle="m-tooltip" data-placement="top" title="Add new Category">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#category-add-modal" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-plus"></i></a>
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
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>Date</th>
                                                <th>Total Product</th>
                                                <th>Total Amount</th>
                                                <th>Payment Type</th>
                                                <th>Payment Status</th>
                                                <th>Delever</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($orders as $order) { ?>                                       
                                        <tr>
                                                <td><?= $order["id"]; ?></td>
                                                <td><?= $order["name"]; ?></td>
                                                <td><?= $order["email"]; ?></td>
                                                <td><?= $order["contact"]; ?></td>
                                                <td><?= $order["city"]; ?></td>
                                                <td><?= $order["date"]; ?></td>
                                                <td><?= $order["total_product"]; ?></td>
                                                <td><?= $order["total_amount"]; ?></td>
                                                <td><?= $order["payment_type"]; ?></td>
                                                <td><center><?php if($order["payment_status"] == 'Done'){ echo '<span class="label label-success">Done</span>'; }else{ echo '<span class="label label-warning">Pending</span>'; } ?></center></td>
                                                <td><center><?php if($order["delever"] == 'Done'){ echo '<span class="label label-success">Done</span>'; }else{ echo '<span class="label label-warning">Pending</span>'; } ?></center></td>
                                                <td>
                                                	<button class="btn btn-success btn-sm rounded-0 edit_order_btn" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-order_id="<?= $order["id"]; 0?>"><i class="fa fa-edit"></i></button>
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
                                                
    <!--begin::Modal-->
    <div class="modal fade" id="order-edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit-order-form">
                    	<input type="hidden" id="edit-order-id" name="order_id">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Payment Status</label>
                            <select class="form-control" name="payment_status" id="edit-payment_status">
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Delever Status</label>
                            <select class="form-control" name="delever" id="edit-delever">
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
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
    $('#category-table').DataTable();
</script>
<!-- end::Body -->

</html>