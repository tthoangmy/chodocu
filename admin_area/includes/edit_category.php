
<?php
    $edit_cat = mysqli_query($con,"SELECT * FROM categories where cat_id='$_GET[cat_id]'");
    $fetch_cat = mysqli_fetch_array($edit_cat);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Sửa thông tin loại sản phẩm</h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Đổi thành loại sản phẩm mới :</b></td>
                <td><input type="text" name="product_cat" value="<?php echo($fetch_cat['cat_title']); ?>" size="60" required value=""></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="edit_cat" value="Lưu thay đổi" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['edit_cat'])) {
    
    $cat_title = mysqli_real_escape_string($con,$_POST['product_cat']);

    $edit_cat = mysqli_query($con,"UPDATE categories set cat_title = '$cat_title' where cat_id='$_GET[cat_id]'");

    if ($edit_cat) {
        echo ("<script>alert('Thay đổi loại sản phẩm thành công!')</script>");
        // echo ("<script>window.open(window.location.href,'_self')</script>");
        echo ("<script>window.open('index.php?action=view_cat','_self')</script>");
    }
}
?>