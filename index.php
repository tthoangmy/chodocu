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
    
      <div class="content_wrapper">

        <?php if(!isset($_GET['action'])){?>

        <div id="sidebar">
          <hr>
          <div id="sidebar_title">Sản phẩm</div>
          <hr>
          <ul id="cats">
            <?php
            /*gọi cái hàm này ở bên file functions.php qua á*/
            getCats();
            ?>
          </ul>
          <hr>
          <div id="sidebar_title">Thương hiệu</div>
          <hr>
          <ul id="cats">
            <?php
            /*giống cái trên thôi*/
            getBrands();
            ?>
            <hr>
          </ul>
        </div>
        <div id="content_area">
          <!--thêm vào giỏ hàng-->
          <?php
          /*hàm thêm sản phẩm vào giỏ hàng*/
          cart();
          ?>


          <div id="product_box">

         

          <?php
          /*hàm này nó hiển thị tất cả sản phẩm ở trang chủ*/
          getPro();
          ?>

          <?php
          /*hàm này nó hiển thi danh sách sản phẩm theo danh mục*/
          get_pro_by_cat_id();
          ?>

          <?php
          /*hàm này nó hiển thị danh sách sản phẩm theo thương hiệu*/
          get_pro_by_brand_id();
          ?>

          

          </div> <!--end product_box-->
        </div> <!--end content_area-->
        <?php }else{ ?>
        <?php include('login.php'); 
      }
      ?>
      </div><!--/.content_wrapper -->
     <?php
     include('includes/footer.php');
     ?>
