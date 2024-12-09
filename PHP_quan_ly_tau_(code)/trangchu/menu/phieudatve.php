<?php
// Kết nối cơ sở dữ liệu
include './trangchu/ketnoi.php';

$hasAlert = false;  // Biến kiểm tra xem có cần thông báo hay không
$alertMessage = '';  // Thông báo cần hiển thị

// Xử lý xóa
if (isset($_GET['delete'])) {
    $maphieuToDelete = $_GET['delete'];
    $conn->query("SET foreign_key_checks = 0");

    $sqlDelete = "DELETE 
    from phieudat
    WHERE phieudat.maphieu ='$maphieuToDelete' ";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "<script>alert('Bạn đã xóa thành công');</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Xử lý tìm kiếm
if (isset($_POST['search'])) {
    $keyword1 = $_POST['keyword1']; // Ô nhập liệu chung cho Họ tên hoặc Mã Phiếu
    $keyword2 = $_POST['keyword2']; // Ô nhập liệu cho Số Điện Thoại

    // Kiểm tra nếu cả hai trường đều được nhập
    if (empty($keyword1) || empty($keyword2)) {
        $hasAlert = true;
        $alertMessage = 'Bạn cần nhập cả Mã Phiếu hoặc Họ Tên và Số Điện Thoại.';
    } else {
        // Kiểm tra số điện thoại có bắt đầu bằng 0 và có độ dài hợp lệ (9-11 số)
        if (!preg_match('/^0\d{8,10}$/', $keyword2)) {
            $hasAlert = true;
            $alertMessage = 'Số điện thoại phải bắt đầu bằng 0 và có độ dài từ 9 đến 11 chữ số.';
        } else {
            // Tìm kiếm theo Họ Tên hoặc Mã Phiếu (LIKE) và Số Điện Thoại (chính xác)
            $sqlSearch = "SELECT DISTINCT 
                p.maphieu, 
                CASE WHEN p.tinhtrangve = 'Đã Thanh Toán' THEN 'Chưa Thanh Toán' ELSE 'Đã Thanh Toán' END AS tinhtrangve,
                p.tenkhach, 
                p.sodienthoai, 
                tau.tentau,
                toa.tentoa,
                ghe.tenghe,
                g1.tengadi, 
                g2.tengaden, 
                ct.gioden,
                ct.giodi,
                ct.machitiet,
                ct.magiave,
                giave.giatien
            FROM phieudat p
            INNER JOIN chitietlich ct ON p.machitiet = ct.machitiet
            INNER JOIN ghe ON p.maghe = ghe.maghe
            INNER JOIN toa ON ghe.matoa = toa.matoa
            INNER JOIN tau ON toa.matau = tau.matau
            INNER JOIN lichtrinh ON tau.matau = lichtrinh.matau
            INNER JOIN gadi g1 ON ct.magadi = g1.maga
            INNER JOIN gadi g2 ON ct.magaden = g2.maga
            INNER JOIN giave ON ct.magiave = giave.magiave
            WHERE (p.maphieu LIKE '%$keyword1%' OR p.tenkhach LIKE '%$keyword1%')
            AND p.sodienthoai = '$keyword2'";
        }
    }
}

// Thực thi truy vấn tìm kiếm
if (isset($sqlSearch)) {
    $result = $conn->query($sqlSearch);
} else {
    // Truy vấn mặc định khi không có tìm kiếm
    $sql = "SELECT DISTINCT 
        p.maphieu, 
        CASE WHEN p.tinhtrangve = 'Đã Thanh Toán' THEN 'Chưa Thanh Toán' ELSE 'Đã Thanh Toán' END AS tinhtrangve,
        p.tenkhach, 
        p.sodienthoai, 
        tau.tentau,
        toa.tentoa,
        ghe.tenghe,
        g1.tengadi, 
        g2.tengaden, 
        ct.gioden,
        ct.giodi,
        ct.machitiet,
        ct.magiave,
        giave.giatien
    FROM phieudat p
    INNER JOIN chitietlich ct ON p.machitiet = ct.machitiet
    INNER JOIN ghe ON p.maghe = ghe.maghe
    INNER JOIN toa ON ghe.matoa = toa.matoa
    INNER JOIN tau ON toa.matau = tau.matau
    INNER JOIN lichtrinh ON tau.matau = lichtrinh.matau
    INNER JOIN gadi g1 ON ct.magadi = g1.maga
    INNER JOIN gadi g2 ON ct.magaden = g2.maga
    INNER JOIN giave ON ct.magiave = giave.magiave";

    $result = $conn->query($sql);
}

// Hiển thị thông báo nếu có
if ($hasAlert) {
    echo "<script>alert('$alertMessage');</script>";
}

?>

<div class="tenbang">
    <h2> Quản Lý Danh Sách Tình Trạng Vé</h2>
</div>

<form method="post" action="indextrangchu.php?trangchu=phieudatve">
    <div class="timkiem">
        <label for="keyword1">Mã Phiếu hoặc Họ Tên:</label>
        <!-- Giữ lại giá trị của trường tìm kiếm -->
        <input type="text" id="keyword1" name="keyword1" value="<?php echo isset($keyword1) ? htmlspecialchars($keyword1) : ''; ?>">

        <label for="keyword2">Số Điện Thoại:</label>
        <!-- Giữ lại giá trị của trường tìm kiếm -->
        <input type="number" id="keyword2" name="keyword2" value="<?php echo isset($keyword2) ? htmlspecialchars($keyword2) : ''; ?>">

        <input type="submit" name="search" value="Tìm Kiếm">
    </div>
</form>

<table class="table table-bordered table-striped w-100">
    <tr>
        <th> Mã Vé </th> 
        <th> Tên Khách </th> 
        <th> Số điện thoại </th> 
        <th> Tàu </th> 
        <th> Toa </th> 
        <th> Ghế </th> 
        <th> Số điểm dừng </th> 
        <th> Ga đi </th> 
        <th> Ga đến </th> 
        <th> Giờ Đi </th> 
        <th> Giờ Đến </th> 
        <th> Giá Vé </th> 
        <th> Tình Trạng Vé </th> 
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>

    <?php
    // Hiển thị kết quả tìm kiếm
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $maphieu = $row["maphieu"];
            $tinhtrangve = $row["tinhtrangve"];
            $iconXoa = ($tinhtrangve == 'Đã Thanh Toán') ? '' : "<a href='#' onclick='confirmDelete(\"$maphieu\")'><i class='bi bi-trash2-fill'></i></a>";

            echo "<tr>
                    <td>" . $row["maphieu"] . "</td>
                    <td>" . $row["tenkhach"] . "</td>
                    <td>" . $row["sodienthoai"] . "</td>
                    <td>" . $row["tentau"] . "</td>
                    <td>" . $row["tentoa"] . "</td>
                    <td>" . $row["tenghe"] . "</td>          
                    <td>" . $row["magiave"] . "</td>
                    <td>" . $row["tengadi"] . "</td>
                    <td>" . $row["tengaden"] . "</td>
                    <td>" . $row["giodi"] . "</td>       
                    <td>" . $row["gioden"] . "</td>        
                    <td>" . $row["giatien"] . "</td>
                    <td>" . $row["tinhtrangve"] . "</td>
                    <td>
                        <a href='indextrangchu.php?trangchu=suaphieudatve&maphieu=$maphieu'><i class='bi bi-pen-fill'></i></a>
                    </td>
                    <td>
                        <div class='suaxoa'>
                            $iconXoa
                        </div>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='14'>Không có dữ liệu.</td></tr>";
    }
    ?>

</table>

<?php
// Đóng kết nối
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

    .tenbang {
        text-align: center;
        margin-bottom: 20px;
    }

    .timkiem {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .timkiem input[type="text"],
    .timkiem input[type="number"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 250px;
        font-size: 1rem;
    }

    .timkiem input[type="submit"] {
        padding: 10px 20px;
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

    /* Icon xóa và sửa */
    .suaxoa a {
        color: #3498db;
        font-size: 1.2rem;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .suaxoa a:hover {
        color: #f39c12; /* Màu vàng khi hover */
    }

    /* Thông báo khi không có dữ liệu */
    .no-data-message {
        text-align: center;
        font-size: 1.2rem;
        color: #e74c3c;
        margin-top: 20px;
    }

    /* Button */
    .btn {
        padding: 10px 20px;
        background-color: #FF6347;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
        margin-top: 10px;
    }

    .btn:hover {
        background-color: #FF4500;
    }
</style>
