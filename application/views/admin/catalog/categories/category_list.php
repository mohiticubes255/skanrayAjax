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

    <!-- Category Modal Starts -->
    <!--begin::Modal-->
    <div class="modal fade" id="category-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="add-category">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Category Name</label>
                            <input type="text" class="form-control" id="category-name" name="category_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort-order" name="sort_order">
                            <input type="hidden" name="action" value="add_category">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Parent Category</label>
                            <select class="category form-control" name="parent_id">
                                <option value="">Select Parent</option>
                                <?php
                                foreach ($parents as $parent) { ?>
                                    <option value="<?= $parent['id'];?>"><?= $parent['name'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Modal Ends -->

    <!-- Category Modal Starts -->
    <!--begin::Modal-->
    <div class="modal fade" id="category-edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit-category">
                    	<input type="hidden" id="edit-category-id" name="category_id">
                    	<input type="hidden" name="action" value="update_category">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Category Name</label>
                            <input type="text" class="form-control" id="edit-category-name" name="category_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Sort Order</label>
                            <input type="number" class="form-control" id="edit-sort-order" name="sort_order">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Parent Category</label>
                            <select class="category form-control" name="parent_id" id="edit-parent_id">
                                
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

    <!-- Category Modal Ends -->
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
                                                Manage Categories
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
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($lists as $list) { ?>                                       
                                        <tr>
                                                <td><?= $list["cat_id"]; ?></td>
                                                <td><?= $list["name"]; ?></td>
                                                <td>
                                                	<button class="btn btn-success btn-sm rounded-0 edit_category_btn" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-category_id="<?= $list["cat_id"]; ?>"><i class="fa fa-edit"></i></button>
                                                	<button class="btn btn-danger btn-sm rounded-0 remove_category_btn" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-category_id="<?= $list["cat_id"]; ?>"><i class="fa fa-trash"></i></button>
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