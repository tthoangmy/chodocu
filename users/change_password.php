
 
          <script>
              $(document).ready(function(){

                $("#password_confirm2").on('keyup', function(){
                    // alert('testing jquery');

                    var password_confirm1 = $("#password_confirm1").val();
                    
                    var password_confirm2 = $("#password_confirm2").val();

                    // alert(password_confirm2);

                    if(password_confirm1 == password_confirm2){
                        $("#status_for_confirm_password").html('<strong style="color: green; font-size:12px">Mật khẩu khớp</strong>');
                    }else{
                        $("#status_for_confirm_password").html('<strong style="color: red; font-size:12px">Mật khẩu không khớp</strong>');
                    }

                });

              });
          </script>
        
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
      <h2 class="title"> Thay đổi mật khẩu</h2>
      <br>

      <div class="email-login">
         <label for="password"><b>Mật khẩu hiện tại</b></label>
         <input type="password" placeholder="Nhập mật khẩu hiện tại" name="current_password" required>
         <label for="password"><b>Mật khẩu mới</b></label>
         <input type="password" placeholder="Nhập mật khẩu mới" id="password_confirm1" name="new_password" required>
         <label for="confirm_password"><b>Nhập lại mật khẩu mới</b></label>
         <input type="password" placeholder="Nhập lại mật khẩu mới" id="password_confirm1" name="confirm_new_password" required>
      </div>
      <button class="cta-btn" name="change_password" type="submit">Lưu thông tin</button>
   </form>
</div>

<?php
    if(isset($_POST['change_password'])){

            $current_password = trim($_POST['current_password']);
            $hash_current_password = md5($current_password);

            $new_password = trim($_POST['new_password']);
            $hash_new_password = md5($password);
            $confirm_new_password = trim($_POST['confirm_new_password']);

            // $select_password = mysqli_query($con, "select * from users where password='$hash_current_password' and id = '$_SESSION['user_id']'");
            $select_password = mysqli_query($con, "SELECT * FROM users where password='$hash_current_password' AND id = '$_SESSION[user_id]'");

            if(mysqli_num_rows($select_password) == 0){
                echo "<script>alert('Mật khẩu hiện tại chưa đúng !!!')</script>";

            }elseif($new_password != $confirm_new_password){
                echo "<script>alert('Mật khẩu mới không khớp !!!')</script>";
            }else{
                $update = mysqli_query($con, "update users set password='$hash_new_password' where id='$_SESSION[user_id]'");

                if($update){
                    echo "<script>alert('Thay đổi mật khẩu thành công !!!')</script>";

                    echo "<script>window.open(window.location.href,'_self')</script>";
                }else{

                    echo "<scrirpt>alert('Thêm vào database không thành công : mysqli_error($con) !!!')</scrirpt>";
                    
                }
            }

}
?>