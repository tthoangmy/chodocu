<?php
session_start();
if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    echo ("<script>window.open('login.php','_self')</script>");
} else {


?>

    <?php include('../includes/db.php'); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang Admin</title>
        <link rel="stylesheet" href="styles/desktop.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/jquery-3.6.0.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <div class="navbar-header">
                    <h3>
                        <a class="admin_name">
                            Admin Area- <?php

                                        if (isset($_SESSION['name'])) {
                                            echo ($_SESSION['name']);
                                        } else {
                                            // echo ($_SESSION['name']);
                                        }

                                        ?>
                        </a>
                    </h3>
                </div>
                <!--/.navbar-header-->
                <div class="navbar-right-header">

                    <ul class="dropdown-navbar-right">
                        <li>
                            
                            <a><i class="fa fa-user"></i>&nbsp;<i class="fa fa-caret-down"></i></a>
                            <ul class="subnavbar-right">
                                <li><a href="../my_account.php?action=edit_account">Edit profile</a></li>
                                <li><a href="logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="dropdown-navbar-right">
                        <li>
                            <a><i class="fa fa-bell"></i>&nbsp;<i class="fa fa-caret-down"></i></a>
                            <ul class="subnavbar-right">
                                <li><a>Thông Báo</a></li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="dropdown-navbar-right">
                        
                        <li>
                            <a class="icon_home" href="../index.php" style="text-decoration: none;"><i class="fa fa-home" aria-hidden="true"></i>
                                &nbsp;
                                <!-- <p style="margin-left: -16px;">Website</p> -->
                            </a>
                            
                        </li>
                    </ul>
                </div>
                <!--/.navbar-right-header-->
            </div>
            <!--/.header-->
            <div class="body_container">
                <div class="left_sidebar">
                    <div class="left_sidebar_box">
                        <ul class="left_sidebar_first_level">
                            <li><a  target="_blank" class="my_web"><i class="fa fa-dashboard"></i> Quản trị web</a></li>
                            <li>
                                <!--i class="arrow fa fa-angle-left"></i>-->
                                <a class="title_edit_admin" href="#"><i class="fa fa-th-large"></i> &nbsp;Sản phẩm <i class="arrow fa fa-angle-left"></i></a>
                                <ul class="left_sidebar_second_level">

                                    <li><a href="index.php?action=add_pro">Thêm Sản phẩm</a></li>
                                    <li><a href="index.php?action=view_pro">Quản lý Sản Phẩm</a></li>
                                </ul>
                                <!--/.left_sidebar_second_level-->
                            </li>

                            <li>
                                <a class="title_edit_admin" href="#"><i class="fa fa-plus"></i> &nbsp;Thể loại Sản phẩm <i class="arrow fa fa-angle-left"></i></a>
                                <ul class="left_sidebar_second_level">
                                    <li><a href="index.php?action=add_cat">Thêm Loại Sản phẩm mới</a></li>
                                    <li><a href="index.php?action=view_cat">Quản lý Các thể loại</a></li>
                                </ul>
                                <!--/.left_sidebar_second_level-->
                            </li>
                            <li>
                                <a class="title_edit_admin" href="#"><i class="fa fa-plus"></i> &nbsp;Thương Hiệu <i class="arrow fa fa-angle-left"></i></a>
                                <ul class="left_sidebar_second_level">
                                    <li><a href="index.php?action=add_brand">Thêm Thương hiệu mới</a></li>
                                    <li><a href="index.php?action=view_brands">Quản ý Các Thương hiệu</a></li>
                                </ul>
                                <!--/.left_sidebar_second_level-->
                            </li>
                            <li>
                                <a class="title_edit_admin" href="#"><i class="fa fa-gift"></i> &nbsp;Người Dùng <i class="arrow fa fa-angle-left"></i></a>
                                <ul class="left_sidebar_second_level">
                                    
                                    <li><a href="index.php?action=view_users">Quản lý Người Dùng</a></li>
                                </ul>
                                <!--/.left_sidebar_second_level-->
                            </li>
                        </ul>
                        <!--/.left_sidebar_first_level-->
                    </div>
                    <!--/.left_sidebar_box-->

                </div>
                <!--/.left_sidebar-->
                <div class="content">
                    <div class="content_box">
                        <?php
                        if (isset($_GET['action'])) {
                            $action = $_GET['action'];
                        } else {
                            $action = '';
                        }

                        switch ($action) {
                            case 'add_pro';
                                include 'includes/insert_product.php';
                                break;

                            case 'view_pro';
                                include 'includes/view_products.php';
                                break;

                            case 'edit_pro';
                                include 'includes/edit_product.php';
                                break;

                            case 'add_cat';
                                include 'includes/insert_category.php';
                                break;

                            case 'view_cat';
                                include 'includes/view_categories.php';
                                break;

                            case 'edit_cat';
                                include 'includes/edit_category.php';
                                break;

                            case 'add_brand';
                                include 'includes/insert_brand.php';
                                break;
                            case 'view_brands';
                                include 'includes/view_brands.php';
                                break;

                            case 'edit_brand';
                                include 'includes/edit_brand.php';
                                break;

                            case 'view_users';
                                include 'includes/view_users.php';
                                break;
                        }
                        ?>
                    </div>
                    <!--/.content_box-->
                </div>
                <!--/.content-->
            </div>
            <!--/.body-container-->
        </div>
        <!--/.container-->
    </body>

    </html>



    <!-- hiệu ứng tạo thanh menu trượt -->

    <!--Cái js này là :sau khi click vào biểu tượng or... thì nó sẽ xử lý.
        thì ở đây thì ta sẽ thực hiện tìm kiếm class để xử lý bằng hàm find() ,
        rồi tiếp tục sử dụng hàm slideToggle() : nó tựa như chức năng :hover
        với tốc độ là fast -->
    <script>
        //thanh products,categories
        $(document).ready(function() {
            $(".dropdown-navbar-right").on('click', function() {
                $(this).find(".subnavbar-right").slideToggle('fast');
            });
            // thông báo,account
            $(".left_sidebar_first_level li").on('click', this, function() {
                $(this).find(".left_sidebar_second_level").slideToggle('fast');
            });
        });
    </script>
<?php } ?>