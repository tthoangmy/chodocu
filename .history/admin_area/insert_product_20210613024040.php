<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Thêm Sản Phẩm Mới</h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Tên Sản Phẩm</b></td>
                <td><input type="text" name="product_title" size="60" required value=""></td>
            </tr>
            <tr>
                <td><b>Danh Mục Sản Phẩm</b></td>
                <td>
                    <select name="product_cat" id="">
                        <option value="">Chọn một danh mục</option>
                        <?php
                        $get_cats = "SELECT * from categories";
                        $run_cats = mysqli_query($con, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                            echo "<option value = '$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Thương Hiệu Sản Phẩm : </b></td>
                <td>
                    <select name="product_brand" id="">
                        <option value="">Chọn một thương hiệu</option>
                        <?php
                        $get_brands = "SELECT * from brands";
                        $run_brands = mysqli_query($con, $get_brands);

                        while ($row_brands = mysqli_fetch_array($run_brands)) {
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                            echo "<option value = '$brand_id'>$brand_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Hình Ảnh Sản Phẩm : </b></td>
                <td><input type="file" name="product_image" /></td>
            </tr>
            <tr>
                <td><b>Giá Sản Phẩm : </b></td>
                <td><input type="text" name="product_price" required/ id=""></td>
            </tr>
            <tr>
                <td valign = "top"><b>Mô tả bản phẩm</b></td>
                <td><textarea name="product_desc" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><b>Từ Khoá Tìm Kiếm Sản Phẩm : </b></td>
                <td><input type="text" name="product_keywords" required/ id=""></td>
            </tr>
            <tr>
                <td colspan="7"><input type="submit" name="insert_post" value="Thêm Sản Phẩm Mới" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_post'])) {
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
    $product_keywords = $_POST['product_keywords'];

    //getting the image from the field
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    // echo( $product_title);
    // echo($product_cat);
    // echo($product_brand);
    echo ($product_price);
    // echo($product_desc);
    // echo($product_image);
    // echo($product_image_tmp);

    move_uploaded_file($product_image_tmp, "product_images/$product_image");

    $insert_product =
        "INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) 
        value('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
    $insert_pro = mysqli_query($con, $insert_product);

    if ($insert_pro) {
        echo ("<script>alert('Thêm sản phẩm thành công!')</script>");
        //echo ("<script>window.open('index.php?insert_product','_self')</script>");
    }
}
?>