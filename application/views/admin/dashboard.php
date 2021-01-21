<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <?php include_once VIEWPATH . "/admin/includes/head.php"; ?>
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

                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">Hello Admin</h3>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>

                <!-- END: Subheader -->
                <div class="m-content">

                    <!--Begin::Section-->
                    <div class="row">
                        <div class="col-xl-6">

                            <!--begin::Portlet-->

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

        <!-- end::Footer -->
    </div>

    <!-- end:: Page -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>

    <!-- end::Scroll Top -->

    <!-- begin::Quick Nav -->
    <!-- <ul class="m-nav-sticky" style="margin-top: 30px;">
        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Purchase" data-placement="left">
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank"><i class="la la-cart-arrow-down"></i></a>
        </li>
        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Documentation" data-placement="left">
            <a href="https://keenthemes.com/metronic/documentation.html" target="_blank"><i class="la la-code-fork"></i></a>
        </li>
        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">
            <a href="https://keenthemes.com/forums/forum/support/metronic5/" target="_blank"><i class="la la-life-ring"></i></a>
        </li>
    </ul> -->

    <!--begin::Page Scripts -->
    <script src="<?php echo base_url('assets/app/js/dashboard.js') ?>" type="text/javascript"></script>

    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>