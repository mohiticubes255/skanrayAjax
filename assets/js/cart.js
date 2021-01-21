$( document ).ready(function() {
    var cid="";
    var cooki_id=getCookie("add_to_card_random");
    if(cooki_id)
    {
    cid=cooki_id;
    get_add_to_card_product(cid);
    }
    console.log(cid);
});
$(document).on("click",".add_to_card",function(){
 var product_id=$(this).data("id");
 var product_price=$("#price_"+product_id).val();
 var product_que=$("#quenty_"+product_id).val();
 var cooki_id=getCookie("add_to_card_random");
 var cid=""
 if(cooki_id)
 {
   cid=cooki_id
 }
 else
 {
 	var d = new Date();
 	var val=Date.parse(d);
 	setCookie("add_to_card_random", val, 1);
 	cid=getCookie("add_to_card_random");
 }

 var res=fill_card(cid,product_id,product_price,product_que);
  
});

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function fill_card(cid,product_id,product_price,product_que){
 $.ajax({
   	method:"POST",
   	url:BASE_URL+"shop/cart",
   	data:{"cid":cid,"product_id":product_id,"product_price":product_price,"product_que":product_que,"status":"fill_card"},
   	dataType:"html",
    beforeSend: function () {
    $(".ajax_modal").show();
    },
    complete: function () {
        $(".ajax_modal").hide();
    },
   	success:function(data){
   		get_add_to_card_product(cid);
   	  }
   });
 
}

function get_add_to_card_product(cid)
{

   $.ajax({
   	method:"POST",
   	url:BASE_URL+"shop/cart",
   	data:{"cid":cid,"status":"get_add_to_card_product"},
   	dataType:"html",
    beforeSend: function () {
    $(".ajax_modal").show();
    },
    complete: function () {
        $(".ajax_modal").hide();
    },
   	success:function(data){
   		
   		$("#show_card_produst").empty();
   		$("#show_card_produst").html(data);
   	  }
   });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$(document).on("click",".remove_product",function(){
   var id=$(this).data("id");
    $.ajax({
   	method:"POST",
   	url:BASE_URL+"shop/cart",
   	data:{"id":id,"status":"remove_product"},
   	dataType:"json",
    beforeSend: function () {
    $(".ajax_modal").show();
    },
    complete: function () {
        $(".ajax_modal").hide();
    },
   	success:function(data){
   		  get_add_to_card_product(data.data.cid);
   	  }
   });

});

function get_add_to_card_product(cid)
{

   $.ajax({
      method:"POST",
      url:BASE_URL+"shop/cart",
      data:{"cid":cid,"status":"get_add_to_card_product"},
      dataType:"html",
      beforeSend: function () {
      $(".ajax_modal").show();
      },
      complete: function () {
      $(".ajax_modal").hide();
      },
      success:function(data){
         
         $("#show_card_produst").empty();
         $("#show_card_produst").html(data);
        }
   });
}

$(document).on("click",".set_quenty",function(){
    var id=$(this).data("id");
     $.ajax({
       method:"POST",
       url:BASE_URL+"shop/cart",
       data:{"id":id,"status":"set_quenty"},
       dataType:"json",
       success:function(data){
            get_add_to_card_product_for_card_view(data.data.cid);
         }
    });
 
 });
 
 $(document).on("click",".remove_product_from_card_page",function(){
    var id=$(this).data("id");
     $.ajax({
        method:"POST",
        url:BASE_URL+"shop/cart",
        data:{"id":id,"status":"remove_product"},
        dataType:"json",
        success:function(data){
              get_add_to_card_product_for_card_view(data.data.cid);
          }
    });
 
 });

function get_add_to_card_product_for_card_view(cid)
{

   $.ajax({
      method:"POST",
      url:BASE_URL+"shop/cart",
      data:{"cid":cid,"status":"get_add_to_card_product_view"},
      dataType:"html",
      success:function(data){
         
         $("#show_card_produst_dsp_view_card").empty();
         $("#show_card_produst_dsp_view_card").html(data);
        }
   });
}
