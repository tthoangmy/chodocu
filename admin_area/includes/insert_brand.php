<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Thêm hãng</h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Thêm Hãng mới :</b></td>
                <td><input type="text" name="product_brand" size="60" required value=""></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="insert_brand" value="Thêm loại sản phẩm" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_brand'])) {
    
    $product_brand = mysqli_real_escape_string($con,$_POST['product_brand']);

    $insert_brand = mysqli_query($con,"insert into brands (brand_title) values('$product_brand')");

    if ($insert_brand) {
        echo ("<script>alert('Thêm hãng thành công!')</script>");
        // echo ("<script>window.open(window.location.href,'_self')</script>");
        echo ("<script>window.open('index.php?action=view_brands','_self')</script>");
    }
}
?>