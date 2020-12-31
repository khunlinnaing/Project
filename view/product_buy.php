<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
if(isset($_SESSION['user_id'])){
	$date=date('d-m-Y');
?>
<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light my-3 " >
	  <div class="collapse navbar-collapse  justify-content-center" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-item nav-link w-20 prod_buy_today">
	      	<form method="POST">
	      		<input type="hidden" name="product_buy_today" value="buy_today_list">
	      		<?php echo $lang["buy_tea_today"];?>
	      	</form>
	      </a>
	      <a class="nav-item nav-link w-20 buy_day_buy_day">
		    <form method="POST">
		      <input type="hidden" name="product_buy_today" value="check_day_buy_day">
		      	<?php echo $lang["buy_tea_daily_list"];?>
		      </form>
		   </a>
	      <a class="nav-item nav-link w-20 buy_month_during_year">
	      	<form method="POST">
		      <input type="hidden" name="product_buy_today" value="check_buy_month">
		      	<?php echo $lang["buy_tea_monthly_list"];?>
		    </form>
	      </a>
	      <a class="nav-item nav-link w-20 management_member">
	      	<form method="POST">
		      <input type="hidden" name="product_buy_today" value="management_department">
		      	<?php echo $lang["management_member"];?>
		    </form>
	      </a>
	    </div>
	  </div>
	</nav>
	<?php
		require "../action/product_buy.php";
	?>
</div>
<?php
	require "footer.php";
	}else{
		echo "<script>window.location.href='login.php';</script>";
	}
?>