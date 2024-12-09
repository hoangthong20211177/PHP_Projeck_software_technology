<?php
//chitietlich.php
// Kết nối cơ sở dữ liệu (đảm bảo $conn đã được thiết lập kết nối trước đó)

// Kiểm tra nếu tham số malichtrinh được truyền qua URL
if (isset($_GET['malichtrinh'])) {
    $malichtrinh = $_GET['malichtrinh'];

    // Truy vấn chi tiết lịch trình với đầy đủ thông tin, bao gồm sodiendung (magiave) và giatien
    // Sử dụng LEFT JOIN để đảm bảo tất cả các bản ghi từ chitietlich đều được hiển thị
    $sql = "SELECT c.machitiet, t.tentau, c.magadi, g1.tengadi, c.magaden, g2.tengaden, c.giodi, c.gioden,
                   c.magiave AS sodiendung, gv.giatien
            FROM chitietlich c
            JOIN lichtrinh l ON c.malichtrinh = l.malichtrinh
            JOIN tau t ON l.matau = t.matau
            LEFT JOIN gadi g1 ON c.magadi = g1.maga  -- Ga đi
            LEFT JOIN gadi g2 ON c.magaden = g2.maga  -- Ga đến
            LEFT JOIN giave gv ON c.magiave = gv.magiave
            WHERE c.malichtrinh = '$malichtrinh'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<h2>Chi Tiết Lịch Trình</h2>";
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Mã Chi Tiết</th><th>Tên Tàu</th><th>Ga Đi</th><th>Ga Đến</th><th>Giờ Đi</th><th>Giờ Đến</th><th>Số Điểm Dừng</th><th>Giá Vé</th><th>Đặt Vé</th></tr>";
        
        // Hiển thị chi tiết các chuyến đi
        while ($row = $result->fetch_assoc()) {
            $machitiet = $row['machitiet'];
            $tentau = $row['tentau'];
            $tengadi = $row['tengadi'];
            $tengaden = $row['tengaden'];
            $giodi = $row['giodi'];
            $gioden = $row['gioden'];
            $sodiendung = $row['sodiendung']; // Đây chính là magiave
            $giatien = $row['giatien'];
            
            echo "<tr>
                    <td>" . $machitiet . "</td>
                    <td>" . $tentau . "</td>
                    <td>" . $tengadi . "</td>
                    <td>" . $tengaden . "</td>
                    <td>" . $giodi . "</td>
                    <td>" . $gioden . "</td>
                    <td>" . $sodiendung . "</td>
                    <td>" . number_format($giatien, 0, ',', '.') . " VND</td>
                    <td>
                        <a href='indextrangchu.php?trangchu=datve&machitiet=" . $machitiet . "' class='btn btn-primary'>Đặt Vé</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Không tìm thấy thông tin lịch trình!";
        echo "<br><a href='indextrangchu.php?trangchu=lichtrinh' class='btn btn-primary'>Quay lại danh sách chi tiết lịch</a>";  // Quay lại trang chủ
    }
} else {
    echo "Lỗi: Mã lịch trình không hợp lệ!";
}

$conn->close();
?>
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

    /* Bảng */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }

    table th {
        padding: 12px;
        text-align: center;
        background-color: #3498db; /* Màu nền tiêu đề */
        color: white;
        font-size: 1.1rem;
        border: 1px solid #2980b9;
    }

    table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
    }

    /* Màu sole cho các hàng */
    table tr:nth-child(even) {
        background-color: #ecf0f1;  /* Màu sáng cho dòng chẵn */
    }

    table tr:nth-child(odd) {
        background-color: #f9f9f9;  /* Màu sáng hơn cho dòng lẻ */
    }

    /* Hover khi di chuột qua dòng */
    table tr:hover {
        background-color: #f39c12; /* Màu vàng sáng khi hover */
    }

    table td:hover {
        background-color: #f39c12;
        color: white;
    }

    /* Nút Đặt Vé */
    .btn {
        padding: 8px 16px;
        background-color: #FF6347; /* Màu cam đỏ */
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        text-decoration: none;
        font-size: 1rem;
    }

    .btn:hover {
        background-color: #FF4500; /* Màu đỏ cam khi hover */
    }

    /* Thông báo lỗi */
    .error-message {
        color: red;
        font-size: 1.2rem;
        text-align: center;
        margin-top: 20px;
    }

</style>
