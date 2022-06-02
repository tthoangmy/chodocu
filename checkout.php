<!--import file header.php bên inludes vào :3-->
<?php
include('includes/header.php');
?>
    <!-- <div class="menu_bar">
      <ul id="menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="all_products.php">Tất Cả Sản Phẩm</a></li>
        <li><a href="customer/my account.php">Tài Khoản</a></li>
        <li><a href="cart.php">Giỏ Hàng</a></li>
        <li><a href="contact.php">Hỗ Trợ</a></li>
      </ul>
    </div> -->
    
    <!--chuyen trang khi nhap vao thanh toan-->
      <div class="content_wrapper">      
          <?php
           if(!isset($_SESSION['user_id'])){
               //neu chua dang nhap thi chuyen qua dang nhap
            include('login.php');
        }else{
            // neu dang nhap roi thi chuyen qua thanh toan
            include('payment.php');
        }
          ?>
      </div><!--/.content_wrapper -->
     <?php
     include('includes/footer.php');
     ?>
