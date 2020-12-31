$(document).ready(function(){
	var url=window.location.pathname.split('/');
	var url_length=url.length;
	$(".home_nav").css("color","blue");
	$(".home_nav,.product_nav,.product_buy_nav,.product_sale_nav,.order_nav,.hr_nav,.register_nav,.login_nav").click(function(){
		$("ul").children("li.nav-item").removeClass("active");
		$("ul").children("li.nav-item").children("a").css("color","rgba(0,0,0,.5)");
		$(this).parent("li").addClass("active");
		$(this).css("color", "blue");
		var page=$(this).attr("name");
		Page_Link(page,url_length);
	});
	$("#choosen_languages").on("change",function(){
		var language=$(this).val();
		if(url_length <= 3){
			var action="languages/config.php";
		}else{
			var action="../languages/config.php";
		}
		$.ajax({
			url:action,
			type:"POST",
			data:{"language":language},
			success:function(data){
				location.reload(true);
			}
		});
	});
	$(".check_list_btn").click(function(){
		console.log("hello world");
		window.location.href="../view/product_buy.php";
	});
	$(".prod_buy_today,.buy_day_buy_day,.buy_month_during_year,.management_member").click(function(){
		$(this).children("form").submit();
	});

});
function Page_Link(page,url){
	var page_name = page.toLowerCase();
	if(page_name == "home"){
		if(url==4){
			window.location.href="../index.php";
		} else{
			window.location.href="index.php";
		}
	}else{
		if(url==4){
			window.location.href=page_name+".php";
		}else{
			window.location.href="view/"+page_name+".php";
		}
	}
}