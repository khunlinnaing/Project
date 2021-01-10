<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
if(isset($_SESSION['user_id'])){
	$date=date('d-m-Y');
?>
<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-item nav-link w-20 prod_buy_today">
	      	<form method="POST">
	      		<input type="hidden" name="product_buy_today" value="buy_today_list">
	      		<?php echo $lang["buy_tea_today"];?>
	      	</form>
	      </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-item nav-link w-20 buy_day_buy_day">
		    <form method="POST">
		      <input type="hidden" name="product_buy_today" value="check_day_buy_day">
		      	<?php echo $lang["buy_tea_daily_list"];?>
		      </form>
		   </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-item nav-link w-20 buy_month_during_year">
	      	<form method="POST">
		      <input type="hidden" name="product_buy_today" value="check_buy_month">
		      	<?php echo $lang["buy_tea_monthly_list"];?>
		    </form>
	      </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-item nav-link w-20 management_member">
	      	<form method="POST">
		      <input type="hidden" name="product_buy_today" value="management_department">
		      	<?php echo $lang["management_member"];?>
		    </form>
	      </a>
	      </li>
	    </ul>
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