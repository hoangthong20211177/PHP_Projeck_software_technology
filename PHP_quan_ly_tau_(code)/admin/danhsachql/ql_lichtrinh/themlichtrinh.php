<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $malichtrinh = $_POST['malichtrinh'];
    $tenlichtrinh = $_POST['tenlichtrinh'];
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $matau = $_POST['matau'];

    // Kiểm tra xem mã lịch trình đã tồn tại chưa
    $sqlCheck = "SELECT * FROM lichtrinh WHERE malichtrinh = '$malichtrinh'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        echo "<script>alert('Mã lịch trình này đã tồn tại. Vui lòng chọn mã khác.');</script>";
    } else {
        // Thêm lịch trình
        $sql = "INSERT INTO lichtrinh (malichtrinh, tenlichtrinh, ngaykhoihanh, ngayketthuc, matau)
        VALUES ('$malichtrinh', '$tenlichtrinh', '$ngaykhoihanh', '$ngayketthuc', '$matau')";

        if ($conn->query($sql) === TRUE) {
            // Hiển thị thông báo thành công
            echo "<script>
                    alert('Thêm lịch trình thành công!');
                    window.location.href = 'indexql.php?quanly=lichtrinh'; 
                  </script>";
        } else {
            echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
        }
    }
}

$sqlTau = "SELECT matau, tentau FROM tau";
$resultTau = $conn->query($sqlTau);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Lịch Trình Mới</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Chèn link CSS -->
</head>
<body>

<h2>Thêm Lịch trình Mới</h2>

<form method="post" action="indexql.php?quanly=themlichtrinh">
    <a class='btn btn-info' href='indexql.php?quanly=lichtrinh' role='button'>Quay Lại Bảng Giá Vé</a>

    <label for="malichtrinh">Mã Lịch Trình</label>
    <input type="number" id="malichtrinh" name="malichtrinh" required>

    <label for="tenlichtrinh">Tên Lịch Trình</label>
    <input type="text" id="tenlichtrinh" name="tenlichtrinh" required>

    <label for="ngaykhoihanh">Ngày Khởi Hành</label>
    <input type="date" id="ngaykhoihanh" name="ngaykhoihanh" required>

    <label for="ngayketthuc">Ngày Kết Thúc</label>
    <input type="date" id="ngayketthuc" name="ngayketthuc" required>

    <label for="matau">Mã Tàu</label>
    <select id="matau" name="matau" required>
        <?php
        while ($rowTau = $resultTau->fetch_assoc()) {
            echo '<option value="' . $rowTau['matau'] .'">' . $rowTau['tentau'] . '</option>';
        }
        ?>
    </select>

    <input type="submit" value="Thêm Lịch Trình">
</form>

<script>
    // Lấy ngày hiện tại
    const today = new Date().toISOString().split('T')[0];
    
    // Gán ngày hiện tại cho ngày khởi hành
    document.getElementById('ngaykhoihanh').setAttribute('min', today);
    document.getElementById('ngaykhoihanh').value = today;

    // Kiểm tra ngày kết thúc phải lớn hơn hoặc bằng ngày khởi hành
    document.getElementById('ngayketthuc').addEventListener('change', function () {
        const ngaykhoihanh = document.getElementById('ngaykhoihanh').value;
        const ngayketthuc = document.getElementById('ngayketthuc').value;
        
        if (ngayketthuc < ngaykhoihanh) {
            alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày khởi hành!');
            document.getElementById('ngayketthuc').value = ''; // Xóa ngày kết thúc không hợp lệ
        }
    });
</script>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
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
