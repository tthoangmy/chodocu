<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Shopping</title>
  </head>
  <body>
    <!-- Main container bắt đầu từ đây -->
    <div class="main_wra">
      <div class="header_logo">
         <a href="index.php">
         <img id="logo" src="images/metrixcode100x30.png" width="100px" height="20px">
         </a>
      </div><!--/.header_logo-->
      <div id="form">
      <form method="get" action="results.php" enctype="multipart/form-data">
      <input type="text" name="user_query" placeholder="Tìm kiếm sản phẩm...">
      <input type="sumit" name="search" value="Search">
      </form>
      </div>
      <div class="content_wrapper">
        This is content
      </div><!--/.content_wrapper -->
      <div id="footer">
        Đây là footer
      </div>
    </div><!--/.main_wrapper-->
    <!--Kết thúc Main container tại đây-->
  </body>
</html>
