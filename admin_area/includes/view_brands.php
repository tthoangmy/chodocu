<div class="view_product_box">
    <h2>Xem các Hãng</h2>
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
                    <th>Tên các Hãng</th>
                    <th>Trạng thái</th>
                    <th>Xoá</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <?php
            // kết nối với table product
            $all_brands = mysqli_query($con, "SELECT * FROM brands order by brand_id DESC");
            $i = 1;
            while ($row = mysqli_fetch_array($all_brands)) {


            ?>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="deleteAll[]" value="<?php echo ($row['brand_id']); ?>"></td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($row['brand_title']); ?></td>
                        <td>
                            <!-- <?php
                            if ($row['visible'] == 1) {
                                echo ("Chấp thuận");
                            } else {
                                echo ("đang chờ xử lý");
                            }
                            ?> -->
                        </td>
                        <td><a href="index.php?action=view_brands&delete_brand=<?php echo ($row['brand_id']); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <td><a href="index.php?action=edit_brand&brand_id=<?php echo ($row['brand_id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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

<!-- xoá hãng -->

<?php
if (isset($_GET['delete_brand'])) {
    $delete_brand = mysqli_query($con, "DELETE from brands where brand_id='$_GET[delete_brand]'");

    if ($delete_brand) {
        echo ("<script>alert('Xoá hãng thành công');</script>");
        echo ("<script>window.open('index.php?action=view_brand','_self')</script>");
    }
}


//  xoá các hãng đã chọn bằng vòng lặp foreach -->
if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($con, "DELETE from brands where brand_id='$key'");

        if ($run_remove) {
            echo ("<script>alert('Xoá các hãng đã chọn thành công');</script>");
            echo ("<script>window.open('index.php?action=view_brands','_self')</script>");
        } else {
            echo ("<script>alert('Không thể kết nối với mysql');</script>");
        }
    }
}
?>