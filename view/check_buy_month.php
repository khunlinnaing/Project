<?php
if($_SESSION['lang']=='en'){

?>
<h2 class="text-center my-2"><b><?php echo $lang["buy_tea_monthly_list_in"]." ".date("Y");?></b></h2>
<?php }else{ ?>
	<h2 class="text-center my-2"><b><?php echo date("Y")." ".$lang["buy_tea_monthly_list_in"] ;?></b></h2>
<?php } ?>
<div class="container bg-light">
	<input type="hidden" value="<?php echo date("Y"); ?>">
		<h3 class="text-center my-3"><?php echo $lang["search"] ?></h3>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label class="form-control border-0 bg-light"><?php echo $lang["month_label"] ?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<select class="form-control select_tea_type">
								<?php
								$i=0;
								$month=date('m');
								foreach ($lang["month_name"] as $month_name) {
									if(($month-1)==$i){
										echo "<option value='".$i++."' selected>".$month_name."</option>";
									}else{
											echo "<option value='".$i++."'>".$month_name."</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label class="form-control border-0 bg-light">Product type</label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<select class="form-control select_tea_type">
								<?php
								$i=0;
								foreach ($lang["tea_type_choosen"] as $tea) {
									echo "<option value='".$i++."'>".$tea."</option>";
								}
								?>
							</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row my-2">
		<button class="btn bg-success text-white"><?php echo $lang["download_report"];?></button>
	</div>
	<div class="row">
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">First</th>
		      <th scope="col">Last</th>
		      <th scope="col">Handle</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th scope="row">1</th>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td>Jacob</td>
		      <td>Thornton</td>
		      <td>@fat</td>
		    </tr>
		    <tr>
		      <th scope="row">3</th>
		      <td>Larry</td>
		      <td>the Bird</td>
		      <td>@twitter</td>
		    </tr>
		  </tbody>
		</table>
	</div>
</div>
<script type="text/javascript"></script>