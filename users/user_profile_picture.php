
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

#notification_upload_image{
    color: green;
    font-family: Arial, Helvetica, sans-serif;

}

</style>

<?php 
    $select_user = mysqli_query($con, "select * from users where id='$_SESSION[user_id]'");

    $fetch_user = mysqli_fetch_array($select_user);
?>

<div class="card">
   <form method="post" action="" enctype="multipart/form-data">
      <h2 class="title"> Thay đổi hình ảnh</h2>
      <br>

      <div class="email-login">
         <label for="password"><b>Hình ảnh</b></label>
         <div>
             <img src="upload-files/<?php echo $fetch_user['image'];?>" width="80px" height="80px" style="border-radius: 5px;">
         </div>
         <input type="file" name="image">
      </div>
      <button class="cta-btn" name="user_profile_picture" type="submit">Lưu thông tin</button>
   </form>
</div>

<?php
    if(isset($_POST['user_profile_picture'])){

            if(!empty($_FILES['image']['name'])){

            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            $target_file = "upload-files/" . $image;
            $uploadOk = 1;
            $message = '';
            // gioi han file khog qua 5mb
            if($_FILES["image"]["size"] < 5098888){
            if(file_exists($target_file)){
                 $uploadOk = 0;
                 $message .=" Xin lỗi hình ảnh đã tồn tại !!!";

             }if($uploadOk == 0){
                 $message .= " Hình ảnh của bạn không thể tải lên !!!";

             }else{
                 if(move_uploaded_file($image_tmp, $target_file)){
                     
                    $update_image = mysqli_query($con,"update users set image='$image' where id='$_SESSION[user_id]'");

                    $message .= "Hình ảnh đã được tải lên !!!";
                 }else{
                    $message .= "Xin lỗi, có lỗi xảy ra khi tải lên hình ảnh của bạn !!!";
                 }
             }
            }else{
                $message .= "Xin lỗi, hình ảnh tải lên đã vượt quá 5MB !!!";
            }
        }
}
?>

<p id="notification_upload_image">
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
</p>