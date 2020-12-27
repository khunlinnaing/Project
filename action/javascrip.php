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
		$(".product_amount,.product_price").bind('input', function() {
			$(this).parent("div").children("p").remove();
			$(this).removeClass("border border-danger");
			var val=$(this).val();
			var thousand_spearator_emove=val.replace(/\,/g,'');
			var add_thousand_spearator=thousand_spearator_emove[0]+thousand_spearator_emove[1]+thousand_spearator_emove[2]+thousand_spearator_emove[3];
			if(thousand_spearator_emove[0]==0){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["start_0"];?></p>");
				$(this).addClass("border border-danger");
				$(this).val("");
			}else if(thousand_spearator_emove.length > 4){
				$(this).parent("div").append("<p class='text-danger'><?php echo $lang["no_more_than"];?></p>");
				$(this).addClass("border border-danger");
				$(this).val(add_thousand_spearator.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			}else{
				$(this).val(thousand_spearator_emove.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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