



<?php
$con = mysqli_connect("localhost","root","","thuongmaidientu");
/*kết nối với database*/
if(mysqli_connect_errno()){
  /*nếu kết nối được thì thông báo*/
    echo "Kết nối được thiết lập" . mysqli_connect_error();
}
/*hàm thêm sản phẩm vào giỏ hàng*/

function cart(){
  global $con;
  if(isset($_GET['add_cart'])){
    $product_id = $_GET['add_cart'];

    $ip = get_ip();

    $run_check_pro = mysqli_query($con,"select * from cart where product_id='$product_id'");

    if(mysqli_num_rows($run_check_pro) > 0){
      echo "";
    }else{

      $fetch_pro = mysqli_query($con, "select * from products where product_id = '$product_id'");

      $fetch_pro = mysqli_fetch_array($fetch_pro);

      $pro_title = $fetch_pro['product_title'];

      $run_insert_pro = mysqli_query($con, "insert into cart(product_id,product_title,ip_address) value ('$product_id','$pro_title','$ip')");

      




    }
  }

}

/*hàm này là tính tổng tiền các sản phẩm trong giỏ hàng*/
function total_price(){
  global $con;

  $total = 0;

  $ip = get_ip();

  $run_cart = mysqli_query($con, "select * from cart where ip_address='$ip'");
  
  while($fetch_cart = mysqli_fetch_array($run_cart)){

    $product_id = $fetch_cart['product_id'];

    $result_product = mysqli_query($con,"select * from products where product_id = '$product_id'");

    while($fetch_product = mysqli_fetch_array($result_product)){

      $product_price = array($fetch_product['product_price']);

      $product_title = $fetch_product['product_title'];

      $product_image = $fetch_product['product_image'];

      $sing_price = $fetch_product['product_price'];

      $values = array_sum($product_price);

      $run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id'");

      $row_qty = mysqli_fetch_array($run_qty);

      $qty = $row_qty['quality'];

      $values_qty = $values * $qty;

      $total += $values_qty;
    }
  }
  /*đây là hàm định dạng tiền tệ VN currency_format()*/ 
            /*bắt đầu currency_format()*/
            if (!function_exists('currency_format')) {
              function currency_format($number, $suffix = '₫')
              {
                  if (!empty($number)) {
                      return number_format($number, 0, ',', '.') . "{$suffix}";
                  }
              }
          }
          /* kết thúc currency_format()*/
          $total = currency_format($total);
  echo $total;
}


/*hàm đếm số lượng trong giỏ hàng và hiển thị*/
function total_items(){
  global $con;
  $ip = get_ip();
  $run_items = mysqli_query($con,"select * from cart where ip_address='$ip'");
  echo $count_items = mysqli_num_rows($run_items);
}


/*hàm lấy địa chỉ ip*/
function get_ip(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      //ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      //ip pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}




/*cái hàm này là để lấy ra tên của sản phẩm nhé*/
function getCats(){
    
    global $con;

    $get_cats = "select * from categories";

    $run_cats = mysqli_query($con, $get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){
      $cat_id = $row_cats['cat_id'];

      $cat_title = $row_cats['cat_title'];

      echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

/*còn cái hàm này là để lấy ra tên của thương hiệu*/
function getBrands(){

            global $con;
            $get_brands = "select * from brands";

            $run_brands = mysqli_query($con, $get_brands);

            while($row_brands = mysqli_fetch_array($run_brands)){
              $brand_id = $row_brands['brand_id'];

              $brand_title = $row_brands['brand_title'];

              echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
            }
}

function getPro(){
  /* iseet để kiểm tra biến đã được khai báo chưa hay có rỗng không*/
          /*!isset thì ngược lại*/
          if(!isset($_GET['cat'])){
            if(!isset($_GET['brand'])){

              global $con;

          $get_pro = "select * from products order by RAND() LIMIT 0,8";

          $run_pro = mysqli_query($con, $get_pro);

          while($row_pro = mysqli_fetch_array($run_pro)){
            $pro_id = $row_pro['product_id'];
            $pro_cat = $row_pro['product_cat'];
            $pro_brand = $row_pro['product_brand'];
            $pro_title = $row_pro['product_title'];
            $pro_price = $row_pro['product_price'];
            $pro_image = $row_pro['product_image'];
            /*đây là hàm định dạng tiền tệ VN currency_format()*/ 
            /*bắt đầu currency_format()*/
            if (!function_exists('currency_format')) {
                function currency_format($number, $suffix = '₫')
                {
                    if (!empty($number)) {
                        return number_format($number, 0, ',', '.') . "{$suffix}";
                    }
                }
            }
            /* kết thúc currency_format()*/

            

            $pro_pricess = currency_format($pro_price); /* tạo 1 cái biến để lưu lại hihi*/

            echo "
                  <div id='single_product'>
                  
                  <a href='details.php?pro_id=$pro_id'>
                  <img src='admin_area/product_images/$pro_image' width='220px' height='150px'>
                  <h3>$pro_title</h3>
                  </a>

                  <p><b>$pro_pricess</b></p>


                  <a href='index.php?add_cart=$pro_id'>
                  <button class='button'>
                  <span class='button__text'>
                  <span>C</span><span>H</span><span>Ọ</span><span>N<span><span>  </span><span>M</span><span>U</span><span>A</span>
                  <svg class='button__svg' role='presentational' viewBox='0 0 600 600'>
                    <defs>
                      <clipPath id='myClip'>
                        <rect x='0' y='0' width='100%' height='50%' />
                      </clipPath>
                    </defs>
                    <g clip-path='url(#myClip)'>
                      <g id='money'>
                        <path d='M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                        <path d='M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                      </g>
                      <g id='creditcard'>
                        <path d='M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z' fill='#a76fe2' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                        <path d='M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z' fill='#ffdc67' />
                        <path d='M249.73,183.76h28.85v274.8H249.73Z' fill='#323c44' />
                      </g>
                    </g>
                    <g id='wallet'>
                      <path d='M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                      <path d='M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                      <path d='M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
                      <path d='M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z' fill='#7b8f91' />
                      <path d='M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z' fill='#323c44' />
                    </g>
                
                  </svg>
                </button>
                  </a>
                  </div>
          
             ";
          }
          }
          }
}

function get_pro_by_cat_id(){
  global $con;
  if(isset($_GET['cat'])){
    $cat_id = $_GET['cat'];
    /* đây là câu truy vấn lấy ra thông tin của sản phẩm nếu id danh mục sp trùng nhau*/
    $get_cat_pro = "select * from products where product_cat='$cat_id'";

    $run_cat_pro = mysqli_query($con, $get_cat_pro);

    $count_cats = mysqli_num_rows($run_cat_pro);
    /*đếm số sản phẩm trong danh mục nếu = 0 thì in ra dòng phía dưới*/
    if($count_cats == 0){
      echo "<h2 style='padding:20px;'>Không có sản phẩm nào được tìm thấy trong danh mục này !!!</h2>";
    }

    while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
      $pro_id = $row_cat_pro['product_id'];
      $pro_cat = $row_cat_pro['product_cat'];
      $pro_brand = $row_cat_pro['product_brand'];
      $pro_title = $row_cat_pro['product_title'];
      $pro_price = $row_cat_pro['product_price'];
      $pro_image = $row_cat_pro['product_image'];

      /*đây là hàm định dạng tiền tệ VN currency_format()*/ 
    /*bắt đầu currency_format()*/
    if (!function_exists('currency_format')) {
      function currency_format($number, $suffix = '₫')
      {
          if (!empty($number)) {
              return number_format($number, 0, ',', '.') . "{$suffix}";
          }
      }
  }
  /* kết thúc currency_format()*/

  
  /*ở đây là nếu $count_cats !=0 thì xuất ra sản phẩm theo danh mục đã chọn*/
  $pro_pricess = currency_format($pro_price); /* tạo 1 cái biến để lưu lại hihi*/

  echo "
        <div id='single_product'>
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_image' width='220px' height='150px'>
        <h3>$pro_title</h3>
        </a>
        <p><b>$pro_pricess</b></p>
        <a href='index.php?add_cart=$pro_id'>
        <button class='button'>
        <span class='button__text'>
        <span>C</span><span>H</span><span>Ọ</span><span>N<span><span>  </span><span>M</span><span>U</span><span>A</span>
        <svg class='button__svg' role='presentational' viewBox='0 0 600 600'>
          <defs>
            <clipPath id='myClip'>
              <rect x='0' y='0' width='100%' height='50%' />
            </clipPath>
          </defs>
          <g clip-path='url(#myClip)'>
            <g id='money'>
              <path d='M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
              <path d='M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            </g>
            <g id='creditcard'>
              <path d='M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z' fill='#a76fe2' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
              <path d='M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z' fill='#ffdc67' />
              <path d='M249.73,183.76h28.85v274.8H249.73Z' fill='#323c44' />
            </g>
          </g>
          <g id='wallet'>
            <path d='M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z' fill='#7b8f91' />
            <path d='M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z' fill='#323c44' />
          </g>
      
        </svg>
      </button>
        </a>
        </div>

   ";

    }

  }

}


function get_pro_by_brand_id(){
  global $con;
  if(isset($_GET['brand'])){
    $brand_id = $_GET['brand'];
    /* đây là câu truy vấn lấy ra thông tin của sản phẩm nếu id danh mục sp trùng nhau*/
    $get_brand_pro = "select * from products where product_brand='$brand_id'";
  
    $run_brand_pro = mysqli_query($con, $get_brand_pro);
  
    $count_brands = mysqli_num_rows($run_brand_pro);
    /*đếm số sản phẩm trong danh mục nếu = 0 thì in ra dòng phía dưới*/
    if($count_brands == 0){
      echo "<h2 style='padding:20px;'>Không có sản phẩm nào được tìm thấy trong thương hiệu này !!!</h2>";
    }
  
    while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){
      $pro_id = $row_brand_pro['product_id'];
      $pro_cat = $row_brand_pro['product_cat'];
      $pro_brand = $row_brand_pro['product_brand'];
      $pro_title = $row_brand_pro['product_title'];
      $pro_price = $row_brand_pro['product_price'];
      $pro_image = $row_brand_pro['product_image'];
  
      /*đây là hàm định dạng tiền tệ VN currency_format()*/ 
    /*bắt đầu currency_format()*/
    if (!function_exists('currency_format')) {
      function currency_format($number, $suffix = '₫')
      {
          if (!empty($number)) {
              return number_format($number, 0, ',', '.') . "{$suffix}";
          }
      }
  }
  /* kết thúc currency_format()*/
  
  $pro_pricess = currency_format($pro_price); /* tạo 1 cái biến để lưu lại hihi*/
  /*ở đây là nếu $count_cats !=0 thì xuất ra sản phẩm theo danh mục đã chọn*/
  
  
  echo "
        <div id='single_product'>
        
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_image' width='220px' height='150px'>
        <h3>$pro_title</h3>
        </a>
  
        <p><b>$pro_pricess</b></p>
  
  
        <a href='index.php?add_cart=$pro_id'>
        <button class='button'>
        <span class='button__text'>
        <span>C</span><span>H</span><span>Ọ</span><span>N<span><span>  </span><span>M</span><span>U</span><span>A</span>
        <svg class='button__svg' role='presentational' viewBox='0 0 600 600'>
          <defs>
            <clipPath id='myClip'>
              <rect x='0' y='0' width='100%' height='50%' />
            </clipPath>
          </defs>
          <g clip-path='url(#myClip)'>
            <g id='money'>
              <path d='M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
              <path d='M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z' fill='#699e64' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            </g>
            <g id='creditcard'>
              <path d='M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z' fill='#a76fe2' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
              <path d='M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z' fill='#ffdc67' />
              <path d='M249.73,183.76h28.85v274.8H249.73Z' fill='#323c44' />
            </g>
          </g>
          <g id='wallet'>
            <path d='M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z' fill='#a4bdc1' stroke='#323c44' stroke-miterlimit='10' stroke-width='14' />
            <path d='M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z' fill='#7b8f91' />
            <path d='M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z' fill='#323c44' />
          </g>
      
        </svg>
      </button>
        </a>
        </div>
  
   ";
  
    }
  
  }
}

?>