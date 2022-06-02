<div class="view_product_box">
    <h2>Quản lý Người Dùng</h2>
    <div class="border_bottom"></div>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="search_bar">
            <input type="text" id="search" placeholder="Type to search...">
        </div>

        <table width=100%>
            <thead>
                <tr>
                    <th>Check</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ảnh đại diện</th>
                    <th>Trạng thái</th>
                    <th>Xoá</th>

                </tr>
            </thead>
            <?php
            // kết nối với table product
            $all_users = mysqli_query($con, "SELECT * FROM users order by id DESC");
            $i = 1;
            while ($row = mysqli_fetch_array($all_users)) {


            ?>
                <tbody>
                    <tr>
                        <?php 
                            if($row['role'] !='admin'){
                        ?>
                        <td><input type="checkbox" name="deleteAll[]" value="<?php echo ($row['id']); ?>"></td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($row['name']); ?></td>
                        <td><?php echo ($row['email']) ?></td>
                        <td>
                            <?php if ($row['image'] != '') { ?>
                                <img src="../upload-files/<?php echo ($row['image']) ?>" width="70px" height="50px" alt="">
                            <?php } else { ?>
                                <img src="../images/profile-icon.png" width="70px" height="50px" alt="">
                            <?php } ?>
                        </td>
                        <td>
                            <?php
                            if ($row['visible'] == 1) {
                                echo ("Chấp thuận");
                            } else {
                                echo ("đang chờ xử lý");
                            }
                            ?>
                        </td>
                        <td><a href="index.php?action=view_users&delete_user=<?php echo ($row['id']); ?>"><i class="fa fa-trash" aria-hidden="true"></a></td>
                        <?php 
                            }
                        ?>    
                    </tr>
                </tbody>
            <?php
                $i++;
            }
            ?>

            <tr>
                <td><input type="submit" name="delete_all" value="Remove"></td>
            </tr>
        </table>
    </form>
</div>

<!-- xoá user -->

<?php
if (isset($_GET['delete_user'])) {
    
    $delete_user = mysqli_query($con, "DELETE from user where id='$_GET[delete_user]'");

    if ($delete_user) {
        echo ("<script>alert('Xoá user thành công');</script>");
        echo ("<script>window.open('index.php?action=view_users','_self')</script>");
    }
}


//  xoá các user đã chọn bằng vòng lặp foreach -->
if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($con, "DELETE from user where id='$key'");

        if ($run_remove) {
            echo ("<script>alert('Xoá các users đã chọn thành công');</script>");
            echo ("<script>window.open('index.php?action=view_users','_self')</script>");
        } else {
            echo ("<script>alert('Không thể kết nối với mysql');</script>");
        }
    }
}
?>