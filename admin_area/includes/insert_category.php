<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Thêm loại sản phẩm</h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Thêm loại sản phẩm mới :</b></td>
                <td><input type="text" name="product_cat" size="60" required value=""></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="insert_cat" value="Thêm loại sản phẩm" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_cat'])) {
    
    $product_cat = mysqli_real_escape_string($con,$_POST['product_cat']);

    $insert_cat = mysqli_query($con,"insert into categories (cat_title) values('$product_cat')");

    if ($insert_cat) {
        echo ("<script>alert('Thêm loại sản phẩm thành công!')</script>");
        echo ("<script>window.open('index.php?action=view_cat','_self')</script>");
    }
}
?>