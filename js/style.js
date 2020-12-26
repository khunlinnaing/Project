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
	$(".email").on("input",function(){
	    $(this).val(($(this).val()).toLowerCase());
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