<?php
// Xử lý lấy thông tin lịch trình để hiển thị form sửa
if (isset($_GET['malichtrinh'])) {
    $malichtrinhToEdit = $_GET['malichtrinh'];
    $sqlGetInfo = "SELECT * FROM lichtrinh WHERE malichtrinh = '$malichtrinhToEdit'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc(); 
        $malichtrinh = $rowInfo['malichtrinh'];
        $tenlichtrinh = $rowInfo['tenlichtrinh'];
        $ngaykhoihanh = $rowInfo['ngaykhoihanh'];
        $ngayketthuc = $rowInfo['ngayketthuc'];
        $matau = $rowInfo['matau'];
    } else {
        echo "Không tìm thấy thông tin Lịch trình."; 
        exit();
    }
}

// Xử lý cập nhật thông tin
if (isset($_POST['update'])) {
    $malichtrinh = $_POST['malichtrinh'];
    $tenlichtrinh = $_POST['tenlichtrinh'];
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $matau = $_POST['matau'];

    // Kiểm tra điều kiện ngày kết thúc phải lớn hơn hoặc bằng ngày khởi hành
    if ($ngayketthuc < $ngaykhoihanh) {
        echo "<script>alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày khởi hành!');</script>";
    } else {
        $sqlUpdate = "UPDATE lichtrinh SET tenlichtrinh='$tenlichtrinh', ngaykhoihanh='$ngaykhoihanh',
        ngayketthuc='$ngayketthuc', matau='$matau'
        WHERE malichtrinh='$malichtrinh'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo "<script>
                    alert('Cập nhật thông tin lịch trình thành công!');
                    window.location.href = 'indexql.php?quanly=lichtrinh';
                  </script>";
        } else {
            echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
        }
    }
}

// Lấy thông tin tàu để hiển thị trong dropdown
$sqlTau = "SELECT * FROM tau";
$resultTau = $conn->query($sqlTau);

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Lịch Trình</title>
    <style> 
 /* Cấu trúc cơ bản */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Tiêu đề */
h2 {
    color: #333;
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    font-weight: bold;
}

/* Form */
form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Label */
label {
    display: block;
    margin: 10px 0 5px;
    color: #555;
    font-weight: 600;
}

/* Input và Select */
input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

input[type="date"] {
    font-size: 16px;
}

select {
    font-size: 16px;
}

/* Button - Thêm lịch trình */
input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Nút quay lại */
a.btn-info {
    background-color: #17a2b8;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    display: inline-block;
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

a.btn-info:hover {
    background-color: #138496;
}

/* Cải thiện hiển thị lỗi */
input:invalid {
    border-color: #e74c3c;
}

input:valid {
    border-color: #2ecc71;
}

/* Các lỗi và thông báo */
.alert {
    background-color: #e74c3c;
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-size: 14px;
    display: none;
}
</style>

    </style>
</head>
<body>

<h2>Cập Nhật Lịch Trình</h2>

<form method="post" action="indexql.php?quanly=sualichtrinh">
    <a class="back-button" href="indexql.php?quanly=lichtrinh" role="button">Quay Lại Bảng Lịch Trình</a>

    <label for="malichtrinh">Mã Lịch Trình</label>
    <input type="number" id="malichtrinh" name="malichtrinh" value="<?php echo $malichtrinh; ?>" readonly>

    <label for="tenlichtrinh">Tên Lịch Trình</label>
    <input type="text" id="tenlichtrinh" name="tenlichtrinh" value="<?php echo $tenlichtrinh; ?>" required>

    <label for="ngaykhoihanh">Ngày Khởi Hành</label>
    <input type="date" id="ngaykhoihanh" name="ngaykhoihanh" value="<?php echo $ngaykhoihanh; ?>" required>

    <label for="ngayketthuc">Ngày Kết Thúc</label>
    <input type="date" id="ngayketthuc" name="ngayketthuc" value="<?php echo $ngayketthuc; ?>" required>

    <label for="matau">Mã Tàu</label>
    <select id="matau" name="matau" required>
        <?php
        while ($rowTau = $resultTau->fetch_assoc()) {
            $selected = ($matau == $rowTau['matau']) ? 'selected' : '';
            echo '<option value="' . $rowTau['matau'] . '" ' . $selected . '>' . $rowTau['tentau'] . '</option>';
        }
        ?>
    </select>

    <input type="submit" name="update" value="Cập Nhật Lịch Trình">
</form>

</body>
</html>
