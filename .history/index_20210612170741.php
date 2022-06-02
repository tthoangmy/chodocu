<?php
include("functions/functions.php");

include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
  </head>
  <body>
    <!-- Main container bắt đầu từ đây -->
    <div class="main_wrapper">
     <div class="header_wrapper">
      <div class="header_logo">
         <a href="index.php">
         <img id="logo" src="images/metrixcode100x30.png" width="100px" height="20px">
         </a>
      </div><!--/.header_logo-->
      <div id="form">
      <form method="get" action="results.php" enctype="multipart/form-data">
      <input type="text" name="user_query" placeholder="Tìm kiếm sản phẩm...">
      <input type="submit" name="search" value="Search">
      </form>
      </div>

      <div class="cart">
        <ul>
          <li class="dropdown_header_cart">
            <div id="notification_total_art" class="shopping_cart">
              <img src="images/cart_icon.png" id="cart_image">
            </div>
          </li>
        </ul>
      </div>

      <div class="register_login">
        <div class="login">
          <a href="index.php?action=login">Login</a></div>
          <div class="register"><a href="custommer_register.php">Đăng kí</a></div>
      </div>

    </div> <!--/.header_wrapper-->
    <div class="menu_bar">
      <ul id="menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="all_product.php">Tất Cả Sản Phẩm</a></li>
        <li><a href="customer/my account.php">Tài Khoản</a></li>
        <li><a href="cart.php">Giỏ Hàng</a></li>
        <li><a href="contact.php">Hỗ Trợ</a></li>
      </ul>
    </div>
      <div class="content_wrapper">
        <div id="sidebar">
          <div id="sidebar_title">Sản phẩm</div>
          <ul id="cats">
            <?php
            getCats();
            ?>
          </ul>
          <div id="sidebar_title">Thương hiệu</div>
          <ul id="cats">
            <?php
            getBrands();
            ?>
          </ul>
        </div>
      </div><!--/.content_wrapper -->
      <div id="footer">
        <p style="text-align: center; padding-top: 30px;">&copy; 2021 - <?php echo date('Y');?>by Open Source</p>
      </div>
    </div><!--/.main_wrapper-->
    <!--Kết thúc Main container tại đây-->
  </body>
</html>
