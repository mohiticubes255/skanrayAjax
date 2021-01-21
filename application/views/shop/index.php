<!DOCTYPE html>
<html lang="en">

<head>
    <title>Skenray Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="http://localhost/skanray/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://localhost/skanray/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://localhost/skanray/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://localhost/skanray/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://localhost/skanray/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://localhost/skanray/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://localhost/skanray/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://localhost/skanray/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/skanray/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="http://localhost/skanray/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/skanray/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://localhost/skanray/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/skanray/assets/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="http://demo.webslesson.info/codeigniter-demo/asset/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
    body {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        font-weight: 400;
        line-height: 1.5385;
        color: #333;
        text-align: left;
        background-color: #2196F3
    }

    .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .1875rem
    }

    .card-img-actions {
        position: relative
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
        text-align: center
    }

    .card-img {
        /* width: 350px */
        height: auto;
    }

    .star {
        color: red
    }

    .bg-cart {
        background-color: orange;
        color: #fff
    }

    .bg-cart:hover {
        color: #fff
    }

    .bg-buy {
        background-color: green;
        color: #fff;
        padding-right: 29px
    }

    .bg-buy:hover {
        color: #fff
    }

    a {
        text-decoration: none !important
    }

    .singleProduct {
        padding: 10px;
    }

    .ajaxloader {
        width: 33px;
        float: right;
        padding: 2px;
    }

    .ajax_modal {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.6;
        -moz-opacity: 0.8;
    }

    .center {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 150px;
        background-color: White;
        border-radius: 10px;
        filter: alpha(opacity=100);
        opacity: 1;
        -moz-opacity: 1;
    }

    .center img {
        height: 128px;
        width: 128px;
    }
    </style>
</head>

<body>
    <div class="row d-flex justify-content-center mt-50 mb-50" style="margin-left: 0px;margin-right: 0px;">

        <div class="col-md-2">
            <div class="list-group">
                <h3>Categories</h3>
                <?php
                    foreach($categories as $category)
                    {
                    ?>
                <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector categories"
                            value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?></label>
                </div>
                <?php
                    }
                    ?>
            </div>
            <div class="list-group">
            <h3>Specialities</h3>
            <?php
                    foreach($specialities as $speciality)
                    {
                    ?>
                <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector specialities"
                            value="<?php echo $speciality['SPECIALITYID']; ?>"> <?php echo $speciality['speciality_name']; ?></label>
                </div>
                <?php
                    }
                    ?>
            </div>
            <div class="list-group">
                <h3>Price</h3>
                <input type="hidden" id="hidden_minimum_price" value="<?php echo $min_price["dicount_price"];?>" />
                <input type="hidden" id="hidden_maximum_price" value="<?php echo $max_price["dicount_price"];?>" />
                <p id="price_show"><?php echo $min_price["dicount_price"];?> - <?php echo $max_price["dicount_price"];?>
                </p>
                <div id="price_range"></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="filter_data">

            </div>
            <div class="col-md-12">
            <center>
                <h4>
                    <p class="paginationLinks"></p>
                </h4>
            </center>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="well">
                <h3>My Card</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quenty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="show_card_produst"></tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- </div> -->

    <!-- AJAX Loader Start-->

    <div class="ajax_modal" style="display: none; z-index: 7777777777777777;">
        <div class="center">
            <img alt="" src="<?php echo base_url(); ?>assets/loader.gif" />
        </div>
    </div>

    <!-- AJAX Loader End-->

    <!-- CART SCRIPT START -->
    <script>
    var BASE_URL = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo base_url().'assets/js/cart.js';?>"></script>
    <style>
    #loading {
        text-align: center;
        background: url('<?php echo base_url(); ?>assets/loader2.gif') no-repeat center;
        height: 150px;
    }
    </style>
    <script>
    $(document).ready(function() {

        filter_data(1);

        function filter_data(page) {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var categories = get_filter('categories');
            var specialities = get_filter('specialities');
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            console.log(categories);
            console.log(specialities);
            console.log(minimum_price);
            console.log(maximum_price);
            $.ajax({
                url: "<?php echo base_url(); ?>shop/fetch_data/" + page,
                method: "POST",
                dataType: "JSON",
                data: {
                    categories: categories,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    specialities:specialities
                },
                success: function(data) {
                    $('.filter_data').html(data.product_list);
                    $('.paginationLinks').html(data.pagination_link);
                }
            })
        }

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            filter_data(page);
        });

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }
        $('.common_selector').click(function() {
            filter_data(1);
        });
        $('#price_range').slider({
            range: true,
            min: <?php echo $min_price["dicount_price"];?>,
            max: <?php echo $max_price["dicount_price"];?>,
            values: [<?php echo $min_price["dicount_price"];?>,
                <?php echo $max_price["dicount_price"];?>
            ],
            step: 100,
            stop: function(event, ui) {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data(1);
            }

        });
    });
    </script>

    <!-- CART SCRIPT END -->
</body>

</html>