<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy tất cả các biến phiên
session_unset();

// Hủy phiên
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("Location: login.php");
exit();
?>
