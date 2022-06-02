
<?php
$con = mysqli_connect("localhost","root","","thuongmaidientu");
/* ở đây thì là kết nối code với database*/
if(mysqli_connect_errno()){
    /* nếu lỗi thì thông báo ra dòng phía dưới*/
    echo "Không thể kết nối được với MySQL: " . mysqli_connect_error();
}

mysqli_query($con, "SET NAMES 'utf8'");
?>