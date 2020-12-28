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
	      	<form class="prod_buy_today_form" method="POST">
	      		<input type="hidden" name="product_buy_today" value="buy_today_list">
	      		<?php echo $lang["buy_tea_today"]."(".$date.")";?>
	      	</form>
	      </a>
	      <a class="nav-item nav-link w-20 buy_day_buy_day">
		    <form class="check_day_buy_day_form" method="POST">
		      <input type="hidden" name="product_buy_today" value="check_day_buy_day">
		      	Pricing
		      </form>
		   </a>
	      <a class="nav-item nav-link w-20" href="#">Features</a>
	      <a class="nav-item nav-link w-20" href="#">Pricing</a>
	      <a class="nav-item nav-link w-20" href="#">Features</a>
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