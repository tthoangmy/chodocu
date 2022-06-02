
<?php
$con = mysqli_connect("localhost/phpmyadmin/","root","","thuongmaidientu");

if(mysqli_connect_errno()){
    echo "Fail to connect to MySQL: " . mysqli_connect_error();
}else{
    echo "MySQL has successfully connected";
}
?>