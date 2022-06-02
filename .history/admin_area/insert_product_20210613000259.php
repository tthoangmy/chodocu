
<?php
include('includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserting Product</title>
</head>
<body bgcolor="skyblue">
    <form action="insert_product.php" method="post" enctype="mutipart/form-data">
        <table align="center" width="795" border="2" bgcolor="#187eae">
            <tr align="center">
                <td colspan="7"><h2>Đăng bài mới ở đây</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Tên sản phẩm:</b></td>
                <td><input type="text" name="product_title" size ="60"></td>
            </tr>
            <tr>
                <td align="right"><b>Danh mục sản phẩm:</b></td>
                <td>
                    <select name="product_cat">
                        <option>Chọn danh mục sản phẩm</option>

                        <?php
                        $get_cats = "select * from categories";

                        $run_cats = mysqli_query($con, $get_cats);
                    
                        while($row_cats=mysqli_fetch_array($run_cats)){
                          $cat_id = $row_cats['cat_id'];
                    
                          $cat_title = $row_cats['cat_title'];
                    
                          echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Thương hiệu sản phẩm:</b></td>
                <td>
                    <select name="product_cat">
                        <option>Chọn thương hiệu sản phẩm</option>

                        <?php
                        $get_brands = "select * from brands";

                        $run_brands = mysqli_query($con, $get_brands);
            
                        while($row_brands = mysqli_fetch_array($run_brands)){
                          $brand_id = $row_brands['brand_id'];
            
                          $brand_title = $row_brands['brand_title'];
            
                          echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Hình ảnh sản phẩm:</b></td>
                <td><input type="file" name="product_image"></td>
            </tr>

            <tr>
                <td align="right"><b>Giá tiền sản phẩm:</b></td>
                <td><input type="text" name="product_price"></td>
            </tr>
        </table>
    </form>
</body>
</html>