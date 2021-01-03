$(document).ready(function(){
	$(".profile_upload").on("input",function(){
		var file_type=$(this).val().split('.').pop().toLowerCase();
		if (file_type=='jpeg' || file_type=='jpg' || file_type=='png') {
			readURL(this);
			$(this).hide();		
        }else{
        	alert("Upload only png,jpeg,jpg");
          $(this).val('');
        }
	});
	$(".change_profile").click(function(){
		$(".image_upload,.change_profile").css('display','none');
		$(".profile_upload").css('display','block');
		$(".profile_upload").val("");
	});
	$("#male,#female").click(function(){
		$(".gender").val($(this).val());
	});
	$(".first_name,.last_name").on("input",function(){
	    $(this).val(toTitleCase($(this).val()));
	  });
	$(".email,.login_email").on("input",function(){
	    $(this).val(($(this).val()).toLowerCase());
	});
	$(".product_amount,.product_price").on("input",function(){
		var product_amount=($(".product_amount").val()).replace(/\,/g,'');
		var product_price=($(".product_price").val()).replace(/\,/g,'');
		$(".total_price").val(Calculate_Total_value(product_amount,product_price));
	});
	$(".update_product_price,.update_product_amount").on("input",function(){
		var update_product_amount=($(".update_product_amount").val()).replace(/\,/g,'');
		var update_product_price=($(".update_product_price").val()).replace(/\,/g,'');
		$(".updat_total_price").val(Calculate_Total_value(update_product_amount,update_product_price));
	});
	$(document).on("click",".edit_btn_today",function(){
		var type=$(this).parent("div").parent("td").parent("tr").children("td:eq(2)").children(".modual_product_type").val();
		var valiage_name=$(this).parent("div").parent("td").parent("tr").children("td:eq(3)").children(".customer_valiage_name").val();
		$("#update_modal_today").modal("show");
		$(".update_customer_name").val($(this).parent("div").parent("td").parent("tr").children("td:eq(1)").text());
		$(".update_product_type").val(type).change();
		$(".update_valiage_name").val(valiage_name).change();
		$(".update_product_amount").val($(this).parent("div").parent("td").parent("tr").children("td:eq(4)").text());
		$(".update_product_price").val($(this).parent("div").parent("td").parent("tr").children("td:eq(5)").text());
		$(".updat_total_price").val($(this).parent("div").parent("td").parent("tr").children("td:eq(6)").text());
		$(".update_by_product_id").val($(this).parent("div").children(".product_id").val());
	});
	$(document).on("click",".delete_btn_today",function(){
		$("#delete_modal_today").modal("show");
		$(".delete_by_product_id").val($(this).parent("div").children(".product_id").val());
	});
	
})


function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();
    reader.onload = function(e) {
    	$(".image_upload,.change_profile").css('display','block');
      	$('.image_upload').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function ShowPassword(){
	 var x = document.getElementById("password");
	 if (x.type === "password") {
	    x.type = "text";
	 } else {
	    x.type = "password";
	 }
}
function toTitleCase(str) {
  return str.replace(
    /\w\S*/g,
    function(txt) {
      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    }
  );
}
function Calculate_Total_value(product_amount,product_price){
	var result=0;
		
		// console.log(parseInt(product_price));
		if(product_price =="" && product_amount !=""){
			result=product_amount;
		}else if(product_price !="" && product_amount ==""){
			result=product_price;
		}else if(product_price =="" && product_amount ==""){
			result=0;
		}else{
			var pro_amount=parseInt(product_amount[0]+product_amount[1]+product_amount[2]+product_amount[3]);
			var pro_price=parseInt(product_price[0]+product_price[1]+product_price[2]+product_price[3]);
			
			result=pro_amount*pro_price;
		}
		result=result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return result;
}
