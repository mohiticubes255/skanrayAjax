<footer class="m-grid__item		m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                <span class="m-footer__copyright">
                    <?php echo date('Y'); ?> &copy; Skanray Technologies Pvt. Ltd
                </span>
            </div>
            <!-- <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">About</span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">Privacy</span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">T&C</span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">Purchase</span>
                        </a>
                    </li>
                    <li class="m-nav__item m-nav__item">
                        <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                            <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                        </a>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>
</footer>

<!-- Category Remove Modal Start -->
        <div class="modal fade" id="remove_category_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Do you really want to delete this Category?</h4>
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form role="form" method="post" id="category_delete_form">
                  <input type="hidden" name="ids" id="delete_category_id" value="0">
                  <input type="hidden" name="action"  value="remove_category">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
        </div>
<!-- Category Remove Modal End -->

<!-- Speciality Remove Modal Start -->
<div class="modal fade" id="remove_speciality_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Do you really want to delete this Speciality?</h4>
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form role="form" method="post" id="speciality_delete_form">
                  <input type="hidden" name="ids" id="delete_speciality_id" value="0">
                  <input type="hidden" name="action"  value="remove_speciality">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
        </div>
<!-- Speciality Remove Modal End -->

<!-- AJAX Loader Start-->

<div class="ajax_modal" style="display: none; z-index: 7777777777777777;">
      <div class="center">
          <img alt="" src="<?php echo base_url('assets/loader.gif') ?>" />
      </div>
</div>

<!-- AJAX Loader End-->
<script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/toastr.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
<!--begin::Global Theme Bundle -->
<script src="<?php echo base_url('assets/vendors/base/vendors.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/base/scripts.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/sweetalert.min.js') ?>"></script>

  
<!--end::Global Theme Bundle -->

<script>
    let BASE_URL = '<?php echo base_url();?>';

    $(document).on('click','.remove_category_btn',function(){
        var category_id = $(this).data('category_id');
        $('#remove_category_modal').modal('show');
        $('#delete_category_id').val(category_id);
    });

    $(document).on('click','.remove_speciality_btn',function(){
        var speciality_id = $(this).data('speciality_id');
        $('#remove_speciality_modal').modal('show');
        $('#delete_speciality_id').val(speciality_id);
    });


  $('#add').click(function(){         
        var numrow = $('.featuresrow').length;
        console.log(numrow);

       $('#dynamic_field').append('<tr id="row'+numrow+'" class="dynamic-added featuresrow"><td style="border:none!important;padding:0px 8px;"><input type="text" name="features[]" placeholder="Product Features" class="form-control name_list" required /></td><td style="border:none!important;padding:0px 8px;"><button style="margin-top: 3px;" type="button" name="remove" id="'+numrow+'" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td></tr>');  

  });



  $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");   

       $('#row'+button_id+'').remove();  

  }); 

      window.onload = function() {
      //Check File API support
      if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.getElementById("files");
        filesInput.addEventListener("change", function(event) {
          var files = event.target.files; //FileList object
          var output = document.getElementById("result");
          for (var i = 0; i < files.length; i++) {
            var file = files[i];
            //Only pics
            if (!file.type.match('image'))
              continue;
            var picReader = new FileReader();
            picReader.addEventListener("load", function(event) {
              var picFile = event.target;
              var div = document.createElement("div");
              div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                "title='" + picFile.name + "'/>";
              output.insertBefore(div, null);
            });
            //Read the image
            picReader.readAsDataURL(file);
          }
        });
      } else {
        console.log("Your browser does not support File API");
      }
    }

    $("#category_delete_form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#category_delete_form").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/categories',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });

    $("form#add_product_form").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
                url: BASE_URL+'web/catalog/add_product',
                type: 'POST',
                data: formData,
                dataType:'json',
                beforeSend: function () {
                $(".ajax_modal").show();
                },
                complete: function () {
                    $(".ajax_modal").hide();
                },
                success: function (res) {
                    if(res.result == 'success'){
                  swal({
                  title: res.msg,
                  text: res.msg,
                  icon: 'success',
                  buttons: {
                  confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                   
                    closeModal: true
                  },
                  }
                })
                }
                setTimeout("location.reload(true);", 1000);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("form#edit_product_form").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
                url: BASE_URL+'web/catalog/edit_product',
                type: 'POST',
                data: formData,
                dataType:'json',
                beforeSend: function () {
                $(".ajax_modal").show();
                },
                complete: function () {
                    $(".ajax_modal").hide();
                },
                success: function (res) {
                    if(res.result == 'success'){
                  swal({
                  title: res.msg,
                  text: res.msg,
                  icon: 'success',
                  buttons: {
                  confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                   
                    closeModal: true
                  },
                  }
                })
                }
                setTimeout("location.reload(true);", 1000);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

    $("#add-category").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#add-category").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/categories',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });

        $(document).on('click','.edit_category_btn',function(){
        var category_id = $(this).data('category_id');
        $('#category-edit-modal').modal('show');
        $('.category').html('');
        $.ajax({
                url: BASE_URL+'web/catalog/edit_single_category',
                type: "POST",
                data: {category_id:category_id},
                dataType:'json',
                // // crossDomain: true,
                // // async: false,
                beforeSend: function () {
                $(".ajax_modal").show();
                },
                complete: function () {
                    $(".ajax_modal").hide();
                },
                success: function(res) {
                    if(res.status == true){
                        $('#edit-category-id').val(res.category[0].id);
                        $('#edit-category-name').val(res.category[0].name);
                        $('#edit-sort-order').val(res.category[0].sort_order);
                        $('.category').html(res.opt);
                    }
                }
            })
        });

        $("#edit-category").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#edit-category").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/edit_category',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });
        
        $(document).on('click','.edit_speciality_btn',function(){
        var speciality_id = $(this).data('speciality_id');
        $('#speciality-edit-modal').modal('show');
        $.ajax({
                url: BASE_URL+'web/catalog/edit_single_speciality',
                type: "POST",
                data: {speciality_id:speciality_id},
                dataType:'json',
                // // crossDomain: true,
                // // async: false,
                beforeSend: function () {
                $(".ajax_modal").show();
                },
                complete: function () {
                    $(".ajax_modal").hide();
                },
                success: function(res) {
                    if(res.status == true){
                        $('#edit-speciality-id').val(res.speciality[0].SPECIALITYID);
                        $('#edit-speciality-name').val(res.speciality[0].speciality_name);
                    }
                }
            })
        });

        $("#edit-speciality").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#edit-speciality").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/edit_speciality',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });

        $("#add-speciality").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#add-speciality").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/specialities',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });

        $("#speciality_delete_form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#speciality_delete_form").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/catalog/specialities',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: 'success',
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });

        $(document).on('click','.edit_order_btn',function(){
        var order_id = $(this).data('order_id');
        $('#order-edit-modal').modal('show');
        $.ajax({
                url: BASE_URL+'web/sales/get_order',
                type: "POST",
                data: {order_id:order_id},
                dataType:'json',
                // // crossDomain: true,
                // // async: false,
                beforeSend: function () {
                $(".ajax_modal").show();
                },
                complete: function () {
                    $(".ajax_modal").hide();
                },
                success: function(res) {
                    // if(res.status == true){
                        $('#edit-order-id').val(res.id);
                        $('#edit-delever').val(res.delever);
                        $('#edit-payment_status').val(res.payment_status);
                        $('#edit-order-id').val(res.id);
                    // }
                }
            })
        });

        $("#edit-order-form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        var formData = $("#edit-order-form").serialize(); 
        console.log(formData);
        $.ajax({
            url: BASE_URL+'web/sales/edit_order',
            type: "POST",
            data: formData,
            dataType:'json',
            // // crossDomain: true,
            // // async: false,
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success: function(res) {
                // if(res.result == 'success'){
              // $('.show_message').html(res.message);
              swal({
              title: res.msg,
              text: res.msg,
              icon: res.icon,
              
              buttons: {
              // cancel: {
                // text: "Cancel",
                // value: null,
                // visible: true,
                
                // closeModal: true,
              // },
              confirm: {
                text: "OK",
                value: true,
                visible: true,
               
                closeModal: true
              },
              }
            })
            // }
            // console.log(res);
        }
        })
            setTimeout("location.reload(true);", 1000);
        });
</script>