
<?php
    $edit_brand = mysqli_query($con,"SELECT * FROM brands where brand_id='$_GET[brand_id]'");
    $fetch_brand = mysqli_fetch_array($edit_brand);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Sửa thông tin Hãng</h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Đổi thành Hãng mới :</b></td>
                <td><input type="text" name="product_brand" value="<?php echo($fetch_brand['brand_title']); ?>" size="60" required value=""></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="edit_brand" value="Lưu thay đổi" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thay đổi brand mới -->
<?php
if (isset($_POST['edit_brand'])) {
    
    $brand_title = mysqli_real_escape_string($con,$_POST['product_brand']);

    $edit_brand = mysqli_query($con,"UPDATE brands set brand_title = '$brand_title' where brand_id='$_GET[brand_id]'");

    if ($edit_brand) {
        echo ("<script>alert('Thay đổi Hãng thành công!')</script>");
        // echo ("<script>window.open(window.location.href,'_self')</script>");
        echo ("<script>window.open('index.php?action=view_brands','_self')</script>");
    }
}
?>