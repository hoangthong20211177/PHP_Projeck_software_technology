<!DOCTYPE html>
<html lang="en">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="bootstrapExp1.css">

<link rel="stylesheet" href="qltau2/csstrangchu/trangchu.css">

<title>Admin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
        <?php

session_start();

$db = new PDO("mysql:host=localhost:3307;dbname=tau_cn", "root", "");
$db->exec("set names utf8");

// Kiểm tra nếu người dùng đã ấn nút đăng nhập
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Lấy thông tin người dùng
    $username = $_POST["user"];
    $password = $_POST["pass"];

    // Làm sạch thông tin
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);

    if ($username == "" || $password == "") {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không được để trống!')</script>";
    } else {
        // Truy vấn để lấy thông tin tài khoản
        $sql = "SELECT * FROM adminnv WHERE taikhoan = '$username' AND matkhau = '$password'";
        $rows = $db->query($sql);
        $rs = $rows->fetch();

        if (!empty($rs)) {
            // Lưu thông tin đăng nhập vào session
            $_SESSION['login_us'] = 'ok';
            $_SESSION['username'] = $username;

            // Kiểm tra role và chuyển hướng
            if ($rs['role'] == 1) {
                header('Location: indexql.php'); // Trang quản lý
            } elseif ($rs['role'] == 2) {
                header('Location: indexnv.php'); // Trang nhân viên
            } else {
                echo "<script>alert('Tài khoản không có quyền truy cập!')</script>";
            }
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!')</script>";
        }
    }
}
?>


<div class="dautrang"> Tổng đài vé Online: 19006469 </div></div>

 <div class="textquantri"> <nav class="navbar">
	 <a  aria-current="trangchu" href="http://localhost/qltau22/qltau2/indextrangchu.php"><img class="logo" src="/qltau2/csstrangchu/anh/logo.jpg"></a>
 <a href="http://localhost/qltau22/qltau2/indextrangchu.php" style="text-decoration:none">	<i class="bi bi-person-square"></i>    Hệ thống quản trị Admin</a>
				</nav></div>

			<div class="top">
			</div>
			<div class="textdangnhap"><a> Đăng Nhập Quản Trị</a>	</div>
						
	<div class="formdangnhap">
<form class="form-vertical" method="post">	
<div class="formdangnhap1"><a><i class="bi bi-person-fill-lock"></i>    Admin</a> </div>							<a> Tài Khoản</a><br>					
<input class="span12" type="text" id="inputEmail"   placeholder="Username" name="user" size="26px"font-size="30%">		<br>											
<a> Mật Khẩu</a><br>											
<input class="span12" type="password" id="inputPassword" placeholder="Password" name="pass"size="26px"><br>										

<div class="formdangnhap2">	
<div class="formdangnhap3">										
<button type="submit" class="btn btn-primary pull-right" style="padding: 4px 10px; font-size: 14px;" >Đăng nhập</button></div>	
<label class="checkbox">
<div class="formdangnhap4">	
<input type="checkbox" name="cb" value="ok"> Nhớ mật khẩu</label>	</div>	</div>									
	</form></div>
</div>						<!--/.wrapper-->
			
<div class="cuoitrang">
	<a >Quản Trị Đường Sắt Việt Nam </a>
								
</div>		
						</body>
						</html>
                        <style>/* Phần form đăng nhập */
.formdangnhap {
    background-color: #ffffff; /* Màu nền của form (background) */
    width: 100%;
    max-width: 400px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 8px;
    border: 2px solid #3498db; /* Màu của khung viền (border) */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
}

/* Màu sắc cho các ô nhập liệu */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 5px;
    border: 1px solid #ccc; /* Màu viền mặc định */
    font-size: 16px;
    outline: none;
    transition: all 0.3s ease;
}

/* Hiệu ứng khi người dùng focus vào ô nhập liệu */
input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #3498db; /* Màu viền khi focus */
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

/* Thay đổi màu nền của form */
.formdangnhap {
    background-color: #f9fafc; /* Màu nền nhạt cho form */
}

/* Khung viền của form */
.formdangnhap {
    border: 2px solid #2980b9; /* Viền màu xanh dương đậm */
}

/* Thêm màu sắc cho button */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #3498db; /* Màu nền của nút */
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Nút khi hover */
button[type="submit"]:hover {
    background-color: #2980b9; /* Màu nền khi hover */
}

/* Phần khung và màu nền của các checkbox */
.checkbox {
    font-size: 14px;
}

.checkbox input {
    margin-right: 8px;
}

/* Khung viền của checkbox khi được chọn */
.checkbox input:checked {
    border-color: #3498db; /* Viền của checkbox khi check */
}

/* Màu nền của phần cuôi trang */
.cuoi {
    text-align: center;
    margin-top: 50px;
    font-size: 14px;
    color: #7f8c8d;
    padding: 10px 0;
    background-color: #2c3e50; /* Nền tối cho phần chân trang */
    color: white; /* Màu chữ sáng */
}

                            /* Tổng quan về bố cục */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Phần đầu trang (Logo và Thông tin) */
.dautrang {
    background-color: #34495e;
    color: white;
    padding: 10px;
    text-align: center;
    font-size: 18px;
}

.textquantri {
    background-color: #2c3e50;
    padding: 10px 0;
    color: white;
    font-size: 20px;
    text-align: center;
}

.textquantri nav a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    margin-right: 20px;
}

.textquantri nav a:hover {
    color: #e74c3c;
}

.textquantri .logo {
    width: 100px;
    margin-right: 20px;
}

/* Phần form đăng nhập */
.textdangnhap {
    text-align: center;
    font-size: 24px;
    margin-top: 40px;
    font-weight: bold;
}

.formdangnhap {
    background-color: white;
    width: 100%;
    max-width: 400px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
}

.formdangnhap a {
    color: #2c3e50;
    font-weight: bold;
    font-size: 18px;
}

.formdangnhap1 {
    font-size: 22px;
    color: #2c3e50;
    font-weight: bold;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.formdangnhap1 i {
    color: #3498db;
    font-size: 24px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    outline: none;
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #2980b9;
}

.checkbox {
    font-size: 14px;
}

.checkbox input {
    margin-right: 8px;
}

.formdangnhap2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.formdangnhap3 {
    width: 100%;
}

.cuoi {
    text-align: center;
    margin-top: 50px;
    font-size: 14px;
    color: #7f8c8d;
}

/* Hiệu ứng hover cho các phần tử */
a:hover {
    color: #e74c3c;
    text-decoration: underline;
}

.formdangnhap4 {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}</style>