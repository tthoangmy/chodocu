<?php
session_start();
include("functions/functions.php");
/*import mấy cái file này vào để tí gọi hàm kkk*/
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <script src="/js/jquery-3.6.0.min.js"></script>
    
  </head>
  <body>
    <!-- Main container bắt đầu từ đây -->
    <div class="main_wrapper">
        <div class="header_wrapper">
          <div class="header_logo">
            <a href="index.php">
            <img id="logo" src="images/metrixcode100x30.png">
            </a>
          </div><!--/.header_logo-->
          <div id="form">
            <form method="get" action="results.php" enctype="multipart/form-data">
              <input type="text" name="user_query" autocomplete="off" placeholder="Tìm kiếm...">
              <input type="submit" name="search" value="Search">
            </form>
          </div>

            <div class="cart">
              <ul>
                <li class="dropdown_header_cart">
                  <div id="notification_total_art" class="shopping_cart">
                    <a href="cart.php"><img src="images/cart_icon.png" id="cart_image"></a>
                    <div class="noti_cart_number">
                      <?php
                      /*hàm đếm số lượng trong giỏ hàng và hiển thị*/
                        total_items();

                      ?>
                    </div>
                  </div>
                </li>
              </ul>
          </div>

            <?php if(!isset($_SESSION['user_id'])){?>


          <div class="register_login">
            <div class="login"><button type="submit" onclick="window.location.href='index.php?action=login'" class="custom-btn btn-15">ĐĂNG NHẬP</button></div>
            <div class="register"><button type="submit" onclick="window.location.href='register.php'" class="custom-btn btn-16">ĐĂNG KÝ</button></div>
          </div>

            <?php }else{?>
            <?php 
            $select_user = mysqli_query($con,"select * from users where id='$_SESSION[user_id]'");
            $data_user = mysqli_fetch_array($select_user);
            ?>
            <div id="profile">
              <ul>
                <li class="dropdown_header">
                  <a>
                    <?php if($data_user['image'] !=''){?>
                      <span><img src="upload-files/<?php echo $data_user['image'];?>" alt=""></span>
                    <?php }else{?>
                      <span><img src="/images/okeicon.png" alt=""></span>
                    <?php }?>
                  </a>
                  <?php if ($_SESSION['role'] != 'admin') { ?>
                                <ul class="dropdown_menu_header">
                                    <li><a href="my_account.php?action=edit_account">Cài đặt Tài khoản</a></li>
                                    <li><a href="logout.php">Đăng xuất</a></li>
 
                                </ul>
                            <?php } else { ?>
                                <ul class="dropdown_menu_header">
                                    <li><a href="my_account.php?action=edit_account">Cài đặt Tài khoản</a></li>
                                    <li><a href="logout.php">Đăng xuất</a></li>
                                    <li><a href="../admin_area/index.php?action=view_pro">Quản trị website</a></li>
                                </ul>
                            <?php } ?>
                  <!-- <ul class="dropdown_menu_header">
                    <li><a href="my_account.php?action=edit_account">Tài khoản</li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                  </ul> -->
                </li>
              </ul>
            </div>
            <?php }?>

    </div> <!--/.header_wrapper-->
    <nav class="skew-menu">
      <ul>
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="all_products.php">Tất Cả Sản Phẩm</a></li>
        <li><a href="customer/my account.php">Tài Khoản</a></li>
        <li><a href="cart.php">Giỏ Hàng</a></li>
        <li><a href="#">Thông Báo</a></li>
        <li><a href="contact.php">Hỗ Trợ</a></li>
        <!-- <li><a href="logout.php">Đăng Xuất</a></li> -->
     </ul>
    </nav>

    <?php include('js/drop_down_menu.php');?>
