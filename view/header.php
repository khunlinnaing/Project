<link rel="shortcut icon" href="../image/logo.png" />
<?php
  $url=$_SERVER['PHP_SELF'];
  $url_len=count(explode("/", $url));
  if($url_len <= 3){
    require "languages/config.php";
  }else{
    require "../languages/config.php";
  }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand home_nav" name="home">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mainnav">
    <ul class="navbar-nav w-100">
      <li class="nav-item active">
        <a class="nav-link home_nav" name="home"><?php echo $lang["home"];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link product_nav" name="product"><?php echo $lang["product"];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link product_buy_nav" name="product_buy"><?php echo $lang["product_buy"];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link product_sale_nav" name="product_sale">Product_sale</a>
      </li>
      <li class="nav-item">
        <a class="nav-link order_nav" name="order">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link hr_nav">Hr_department</a>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end" >
      <?php
        if(isset($_SESSION["user_id"])){
          echo "<img src='data:image;base64," .$_SESSION["user_profile"]. "' class='profile_icon'>";
          echo '<div class="btn-group">
                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.$_SESSION["user_name"].'
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <button class="dropdown-item" type="button">Action</button>
                  <button class="dropdown-item my_profile" name="my_profile" type="button">My Profile</button>
                  <button class="dropdown-item logout" type="button">logout</button>
                </div>
              </div>';
        }else{
      ?>
          <li class="nav-item ">
            <a class="nav-link register_nav" name="register"><?php echo $lang["register"];?></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link login_nav" name="login"><?php echo $lang["login"];?></a>
          </li>
          <?php } ?>
          <li class="nav-item" >
              <select class="mt-3" id="choosen_languages">
                <?php if($_SESSION["lang"]== "en"){ ?>
                  <option value="en"><?php echo $lang["english"];?></option>
                  <option value="my"><?php echo $lang["myanmar"];?></option>
                <? }else{ ?>
                <option value="my"><?php echo $lang["myanmar"];?></option>
                <option value="en"><?php echo $lang["english"];?></option>
              <?php } ?>
              </select>
          </li>
    </ul>
  </div>
</nav>