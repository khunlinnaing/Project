<script type="text/javascript">
	$(document).ready(function(){
		$('.nrc_no,.phone_no,.mobile_no').bind('keypress', function(e) { 
			$(this).parent("div").children("p").remove();
			$(this).removeClass("border border-danger");
			if(( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["nrc_digit_error"];?></p>");
				$(this).addClass("border border-danger");
				return false;
			}
		});
		$(".state_no").on("change",function(){
			var state_no=$(this).val();
			$(".district_name").children().remove();
			$.ajax({
				url:"../action/select.php",
				method:"POST",
				data:{"state":state_no},
				success: function(data){
					$(".district_name").append(data);
				}
			});
		});
		$(".product_amount,.product_price").bind('keypress', function(e) { 
			$(this).parent("div").children("p").remove();
			$(this).removeClass("border border-danger");
			if(( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["nrc_digit_error"];?></p>");
				$(this).addClass("border border-danger");
				return false;
			}
		});
		$(".product_amount,.product_price").bind('input', function(e) {
			var val=$(this).val();
			if(val[0]==0){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["nrc_digit_error"];?></p>");
				$(this).addClass("border border-danger");
				$(this).val("");
			}else if(val.length > 4){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["nrc_digit_error"];?></p>");
				$(this).addClass("border border-danger");
				$(this).val(val[0]+val[1]+val[2]+val[3]);
			}
		});
		$(".logout").click(function(){
			var url=window.location.pathname.split('/');
			var url_length=url.length;
			if(url_length > 3){
				var action="../ajax/register.php";
				var page="login.php";
			}else{
				var action="ajax/register.php";
				var page="view/login.php";
			}
			$.ajax({
				url:action,
				type:"POST",
				data:{"logout":"make logout"},
				success:function(data){
					console.log(data);
					if(data==1){
						window.location.href=page;
					}
				}
			});
		});
	})

</script>