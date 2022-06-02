
<?php
$con = mysqli_connect("localhost","root","","thuongmaidientu");

if(mysqli_connect_errno()){
    echo "Không thể kết nối được với MySQL: " . mysqli_connect_error();
}
?>