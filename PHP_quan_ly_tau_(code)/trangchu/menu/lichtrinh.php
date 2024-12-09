<?php
// Xóa tàu
if (isset($_GET['delete'])) {
    $malichtrinhToDelete = $_GET['delete'];
    $conn->query("SET foreign_key_checks = 0");

    $sqlDelete = "DELETE lichtrinh, chitietlich
    FROM lichtrinh
    LEFT JOIN tau ON lichtrinh.matau = tau.matau
    LEFT JOIN chitietlich ON lichtrinh.malichtrinh = chitietlich.malichtrinh
    WHERE lichtrinh.malichtrinh ='$malichtrinhToDelete' ";

    if ($conn->query($sqlDelete) === TRUE) {  
        echo "Xóa chuyến tàu thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Xử lý tìm kiếm lịch trình
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $ngaykhoihanh = $_POST['ngaykhoihanh'];

    // Kiểm tra cả hai trường dữ liệu (tên lịch trình và ngày khởi hành) có giá trị hợp lệ
    if (!empty($keyword) && !empty($ngaykhoihanh)) {
        // Truy vấn tìm kiếm theo tên lịch trình và ngày khởi hành
        $sqlSearch = "SELECT malichtrinh, tenlichtrinh, ngaykhoihanh, ngayketthuc, matau 
                      FROM lichtrinh 
                      WHERE tenlichtrinh LIKE '%$keyword%' 
                      AND ngaykhoihanh = '$ngaykhoihanh'";

        $result = $conn->query($sqlSearch);
    } else {
        $error_message = "Vui lòng nhập đầy đủ ga đi và ngày khởi hành để tìm kiếm.";
    }
} else {
    // Truy vấn dữ liệu nếu không có tìm kiếm
    $sql = "SELECT malichtrinh, tenlichtrinh, ngaykhoihanh, ngayketthuc, matau FROM lichtrinh";
    $result = $conn->query($sql);
}

// Hiển thị dữ liệu
echo "
<div class='tenbang'>
    <h2> Quản Lý Danh Sách Chuyến Tàu</h2>
</div>
<form method='post' action=''> 
    <div class='timkiem'>
        <input type='text' name='keyword' placeholder='Nhập tên ga đi hoặc ga đến' required>
        <input type='date' name='ngaykhoihanh' required>
        <input type='submit' name='search' value='Tìm Kiếm'> <br>
    </div>
</form>";

if (isset($error_message)) {
    echo "<div class='error-message'>$error_message</div>";
}

// Hiển thị thông báo nếu không có lịch trình
if ($result->num_rows > 0) {
    echo "
    <table class='table table-bordered table-striped w-100'>
        <tr>
            <th>Mã Chuyến Tàu</th>
            <th>Tên Chuyến Tàu</th>
            <th>Ngày Khởi Hành</th>
            <th>Ngày Kết Thúc</th>
            <th>Mã Tàu</th>
            <th>Chi Tiết</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["malichtrinh"] . "</td>
                <td>" . $row["tenlichtrinh"] . "</td>
                <td>" . $row["ngaykhoihanh"] . "</td>
                <td>" . $row["ngayketthuc"] . "</td>
                <td>" . $row["matau"] . "</td>
                <td>
                    <div class='suaxoa'>
                        <a href='indextrangchu.php?trangchu=chitietlich&malichtrinh=" . $row["malichtrinh"] . "'>  
                            <i class='bi bi-info-circle-fill'></i>
                        </a>
                    </div>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    // Nếu không có kết quả tìm kiếm hoặc không có dữ liệu lịch trình
    if (isset($sqlSearch)) {
        // Thông báo không có lịch trình vào ngày khởi hành
        echo "Không có chuyến tàu nào vào ngày " . $_POST['ngaykhoihanh'] . ".";
    } else {
        // Thông báo không có dữ liệu lịch trình
        echo "Không có dữ liệu chuyến tàu.<br><a href='indextrangchu.php?trangchu=lichtrinh' class='btn btn-primary'>Quay lại danh sách chuyến tàu</a>";
    }
    // Thêm nút quay lại trang
    echo "<br><a href='indextrangchu.php?trangchu=lichtrinh' class='btn btn-primary'>Quay lại danh sách chuyến tàu</a>";  // Quay lại trang chủ
}

// Đóng kết nối
$conn->close();
?>  

<!-- CSS styles trực tiếp -->
<style>
    /* Reset margin và padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        padding: 20px;
        color: #333;
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        color: #2C3E50;
        margin-bottom: 20px;
    }

    .tenbang {
        text-align: center;
        margin-bottom: 20px;
    }

    .timkiem {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .timkiem input[type="text"], .timkiem input[type="date"] {
        padding: 10px;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 250px;
        font-size: 1rem;
    }

    .timkiem input[type="submit"] {
        padding: 10px 20px;
        margin: 5px;
        background-color: #FF6347; /* Màu cam đỏ */
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        font-size: 1rem;
    }

    .timkiem input[type="submit"]:hover {
        background-color: #FF4500; /* Màu đỏ cam */
    }

    .error-message {
        color: red;
        text-align: center;
        margin-top: 10px;
    }

    /* Style bảng */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff; /* Màu nền của bảng */
    }

    /* Style tiêu đề bảng */
    table th {
        padding: 12px;
        text-align: center;
        background-color: #3498db;  /* Màu nền tiêu đề bảng */
        color: white;
        font-size: 1.1rem;
        border: 1px solid #2980b9;
    }

    /* Style các ô dữ liệu */
    table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
    }

    /* Màu nền cho các dòng chẵn */
    table tr:nth-child(even) {
        background-color: #ffdbdb;  /* Màu nền nhẹ cho dòng chẵn */
    }

    /* Màu nền cho các dòng lẻ */
    table tr:nth-child(odd) {
        background-color: #ffdbdb;  /* Màu nền nhạt cho dòng lẻ */
    }

    /* Chỉ ra khi người dùng hover qua các dòng bảng */
    table tr:hover {
        background-color: #ffdbdb;  /* Màu vàng sáng khi hover */
    }

    table td:hover {
        background-color: #f39c12;  /* Màu vàng sáng khi hover qua ô */
        color: white;
    }

    .suaxoa a {
        color: #3498db;
        font-size: 1.2rem;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .suaxoa a:hover {
        color: #f39c12; /* Màu vàng khi hover */
    }

    .btn {
        padding: 10px 20px;
        background-color: #FF6347; /* Màu cam đỏ cho nút */
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
        margin-top: 10px;
    }

    .btn:hover {
        background-color: #FF4500; /* Màu đỏ cam khi hover */
    }

</style>
