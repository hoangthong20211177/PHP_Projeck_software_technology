<?php 
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "tau_cn";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
?>