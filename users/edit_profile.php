
        
        <!-- <div class="login_box">
    <form method="post" action="">
        <table align="left" width="70%">
            <tr align="left">
                <td colspan="4">
                    <h2>Welcome</h2> <br>
                </td>
            </tr>
            <tr>
                <td colspan="3"><input type="text" name="email" placeholder="Email hoặc số điện thoại"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="password" name="password" placeholder="Mật khẩu"></td>
            </tr>
            <tr align="left">
                <td colspan="4">
                    <a href="checkout.php?forgot_pass">
                        Quên mật khẩu?
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                <a href="customer_rgister.php">Đăng kí</a>
                </td>
            </tr>
            <tr>
                <td>
                <input type="submit" name="login" value="Đăng nhập">
                </td>
            </tr>
        </table>
    </form>
</div> -->

<style>
body {
  background-color: rgb(228, 229, 247);
}
.social-login img {
  width: 24px;
}
a {
  text-decoration: none;
}

.card {
  font-family: sans-serif;
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 0.7em;
  margin-bottom:3em;
  border-radius: 10px;
  background-color: #ffff;
  padding: 1.8rem;
  box-shadow: 2px 5px 20px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  font-weight: bold;
  margin: 0;
}
.subtitle {
  text-align: center;
  font-weight: bold;
}
.btn-text {
  margin: 0;
}

.social-login {
  display: flex;
  justify-content: center;
  gap: 5px;
}

.google-btn {
  background: #fff;
  border: solid 2px rgb(245 239 239);
  border-radius: 8px;
  font-weight: bold;
  display: flex;
  padding: 10px 10px;
  flex: auto;
  align-items: center;
  gap: 5px;
  justify-content: center;
}
.fb-btn {
  background: #fff;
  border: solid 2px #5086BD;
  border-radius: 8px;
  padding: 10px;
  display: flex;
  align-items: center;
}

.or {
  text-align: center;
  font-weight: bold;
  border-bottom: 2px solid rgb(245 239 239);
  line-height: 0.1em;
  margin: 25px 0;
}
.or span {
  background: #fff;
  padding: 0 10px;
}

.email-login {
  display: flex;
  flex-direction: column;
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

input[type="file"]{
  margin-top: 8px;
  margin-bottom: 15px;
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

.forget-pass {
  text-align: center;
  display: block;
}

</style>

<?php 
    $select_user = mysqli_query($con, "select * from users where id='$_SESSION[user_id]'");

    $fetch_user = mysqli_fetch_array($select_user);
?>

<div class="card">
   <form method="post" action="" enctype="multipart/form-data">
      <h2 class="title"> Chỉnh sửa trang cá nhân</h2>
      <br>

      <div class="email-login">
         <label for="name"> <b>Họ tên</b></label>
         <input type="text" value="<?php echo $fetch_user['name'];?>" placeholder="Họ và tên" name="name" required>
         <label for="" style="margin-bottom: 8px;"><b>Quốc gia</b></label>
         <?php include('users/edit_country_list.php');?>
         <label for="city" style="margin-top: 15px;"> <b>Thành phố</b></label>
         <input type="text" placeholder="Nhập thành phố" value="<?php echo $fetch_user['city'];?>" name="city">
         <label for="contact"> <b>Liên lạc</b></label>
         <input type="text" placeholder="Phương thức liên lạc" value="<?php echo $fetch_user['contact'];?>" name="contact" required>
         <label for="address"> <b>Địa chỉ</b></label>
         <input type="text" placeholder="Địa chỉ liên hệ" value="<?php echo $fetch_user['user_address'];?>" name="address" required>


      </div>
      <button class="cta-btn" name="edit_profile" type="submit">Lưu thông tin</button>
   </form>
</div>

<?php
    if(isset($_POST['edit_profile'])){

        if($_POST['name'] !='' && $_POST['edit_country'] !='' && $_POST['city'] !='' && $_POST['contact'] !='' && $_POST['address'] !=''){
            $name = $_POST['name'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];

            $update_profile = mysqli_query($con,"update users set name='$name', country='$country', city='$city', contact='$contact', user_address='$address' where id='$_SESSION[user_id]'");

            if($update_profile){
                echo "<script>alert('Cập nhật thông tin thành công !!!')</script>";

                echo "<script>window.open(window.location.href,'_self')</script>";
            }

        }
  
}
?>