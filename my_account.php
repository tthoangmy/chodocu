
<style>
    .email-login {
  display: flex;
  flex-direction: column;
  font-family: Arial, Helvetica, sans-serif;
}
.email-login label {
  color: rgb(170 166 166);
}

input[type="text"],
input[type="password"] {
  padding: 10px 15px;
  margin-top: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
}

.cta-btn {
  background-color: #5086BD;
  color: white;
  padding: 18px 20px;
  margin-top: 10px;
  margin-bottom: 20px;
  width: 100%;
  border-radius: 10px;
  border: none;
}
</style>

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
        <?php
            if(isset($_SESSION['user_id'])){
        ?>
     <div class="user_container">
        <div class="user_content">

            <?php
            
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action = '';
            }

            switch($action){

                case  "edit_account";
                include('users/edit_account.php');
                break;

                case  "edit_profile";
                include('users/edit_profile.php');
                break;

                case  "user_profile_picture";
                include('users/user_profile_picture.php');
                break;

                case  "change_password";
                include('users/change_password.php');
                break;
                
                case  "delete_account";
                echo $action;
                break;
        
                case  "my_oder";
                echo $action;
                break;
            }

            // if($_GET['action'] == 'edit_account'){
            //     echo $action;
            // }

            
            
            ?>
            
            <!-- <div class="email-login">
                <label for="email"> <b>Tài khoản</b></label>
                <input type="text" placeholder="Email hoặc số điện thoại" name="email" required>
                <label for="password"><b>Mật khẩu</b></label>
                <input type="password" placeholder="Nhập mật khẩu" name="password" required>
        </div>
    <button class="cta-btn" name="login" type="submit">Đăng nhập</button> -->
        </div>
        <div class="user_sidebar">
            <?php
            $run_image = mysqli_query($con,"select * from users where id='$_SESSION[user_id]'");

            $row_image = mysqli_fetch_array($run_image);

            if($row_image['image'] !=''){

            ?>

            <div class="user_image">
                <img src="upload-files/<?php echo $row_image['image'];?>">
            </div>

            <?php }else{?>

            <div class="user_image">
                <img src="/images/okeicon.png">
            </div>
            
            <?php }?>
            <ul>
                <li><a href="my_account.php?action=my_oder">Quản lý đơn hàng</a></li>
                <li><a href="my_account.php?action=edit_account">Chỉnh sửa thông tin</a></li>
                <li><a href="my_account.php?action=edit_profile">Chỉnh sửa trang cá nhân</a></li>
                <li><a href="my_account.php?action=user_profile_picture">Chỉnh sửa hình ảnh</a></li>
                <li><a href="my_account.php?action=change_password">Thay đổi mật khẩu</a></li>
                <li><a href="my_account.php?action=delete_account">Xóa tài khoản</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>
        
    </div>

    <?php }else{?>

        <h1>Cài đặt tài khoản</h1>

        <h5><a href="index.php?action=login">Đăng nhập</a> vào tài khoản của bạn !!!</h5>
    <?php }?>
      
      </div><!--/.content_wrapper -->
     <?php
     include('includes/footer.php');
     ?>
