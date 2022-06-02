<div class="view_product_box">
    <h2>Xem Sản Phẩm</h2>
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
                    <th>Tên các loại Sản Phẩm</th>
                    <th>Trạng thái</th>
                    <th>Xoá</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <?php
            // kết nối với table product
            $all_categories = mysqli_query($con, "SELECT * FROM categories order by cat_id DESC");
            $i = 1;
            while ($row = mysqli_fetch_array($all_categories)) {


            ?>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="deleteAll[]" value="<?php echo ($row['cat_id']); ?>"></td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($row['cat_title']); ?></td>
                        <td>
                            <!-- <?php
                            if ($row['visible'] == 1) {
                                echo ("Chấp thuận");
                            } else {
                                echo ("đang chờ xử lý");
                            }
                            ?> -->
                        </td>
                        <td><a href="index.php?action=view_cat&delete_cat=<?php echo ($row['cat_id']); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <td><a href="index.php?action=edit_cat&cat_id=<?php echo ($row['cat_id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    </tr>
                </tbody>
            <?php
                $i++;
            }
            ?>

            <tr>
                <td><input type="submit" name="delete_all" value="Xoá"></td>
            </tr>
        </table>
    </form>
</div>

<!-- xoá loại sản phẩm -->

<?php
if (isset($_GET['delete_cat'])) {
    $delete_cat = mysqli_query($con, "DELETE from categories where cat_id='$_GET[delete_cat]'");

    if ($delete_cat) {
        echo ("<script>alert('Xoá loại sản phẩm thành công');</script>");
        echo ("<script>window.open('index.php?action=view_cat','_self')</script>");
    }
}


//  xoá các loại sản phẩm đã chọn bằng vòng lặp foreach -->
if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($con, "DELETE from categories where cat_id='$key'");

        if ($run_remove) {
            echo ("<script>alert('Xoá các loại sản phẩm đã chọn thành công');</script>");
            echo ("<script>window.open('index.php?action=view_cat','_self')</script>");
        } else {
            echo ("<script>alert('Không thể kết nối với mysql');</script>");
        }
    }
}
?>